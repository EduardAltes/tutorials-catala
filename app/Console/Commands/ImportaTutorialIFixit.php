<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Models\Tutorial;
use App\Models\Category;
use App\Models\Step;
use App\Models\Image;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ImportaTutorialIFixit extends Command
{
    protected $signature = 'tutorials:import {guideId}';
    protected $description = 'Importa i tradueix un tutorial des de l’API de iFixit per ID';

    public function handle()
    {
        $guideId = $this->argument('guideId');

        $this->info("Obtenint tutorial amb ID: $guideId");

        $response = Http::get("https://www.ifixit.com/api/2.0/guides/{$guideId}");

        if ($response->failed()) {
            $this->error("No s’ha pogut obtenir el tutorial amb ID: $guideId");
            return 1;
        }

        $data = $response->json();

        $slug = Str::slug($data['title']);

        if (Tutorial::where('slug', $slug)->exists()) {
            $this->warn("Aquest tutorial ja existeix a la base de dades.");
            return 0;
        }

        // Categoria (category)
        $category = Category::firstOrCreate(
            ['slug' => Str::slug($data['category'])],
            ['name' => $data['category']]
        );

        // Crear el tutorial
        $tutorial = Tutorial::create([
            'title' => $data['title'],
            'slug' => $slug,
            'summary' => $data['summary'] ?? '',
            'category_id' => $category->id,
            'difficulty' => $data['difficulty'] ?? null,
            'time_required_min' => $data['time_required_min'] ?? null,
            'time_required_max' => $data['time_required_max'] ?? null,
        ]);

        // Crear Imatge
        $image = Image::create([
            'tutorial_id' => $tutorial->id,
            'url' => $data['image']['original'] ?? '',
            'thumbnail' => $data['image']['thumbnail'] ?? null,
        ]);

        // Traducció
        $tr = new GoogleTranslate('ca');

        // Traduïm el resum
        try {
            $tutorial->summary = $tr->translate($data['summary'] ?? '');
            sleep(1);
        } catch (\Exception $e) {
            $this->warn("Error en la traducció del resum: " . $e->getMessage());
        }

        // Traduïm el títol
        try {
            $tutorial->title = $tr->translate($data['title']);
            sleep(1);
        } catch (\Exception $e) {
            $this->warn("Error en la traducció del títol: " . $e->getMessage());
        }

        // Crear els passos
        foreach ($data['steps'] ?? [] as $index => $stepData) {
            // Traducció dels passos
            $title = $stepData['title'] ?? null;

            if (empty($title) && !empty($stepData['lines'])) {
                $title = $stepData['lines'][0]['text_raw'] ?? '';
            }

            $body = strip_tags($stepData['text'] ?? '');

            // Traducció amb control de càrrega
            try {
                if ($title) $title = $tr->translate($title);
                $body = $tr->translate($body);
                sleep(1); // Evitar ban de Google
            } catch (\Exception $e) {
                $this->warn("Error en la traducció del pas: " . $e->getMessage());
            }

            // Crear el pas
            $step = Step::create([
                'tutorial_id' => $tutorial->id,
                'order' => $index + 1,
                'title' => $title,
                'body' => $body,
            ]);
        }

        // Marcar el tutorial com traduït
        $tutorial->is_translated = true;
        $tutorial->save();

        $this->info("Tutorial importat i traduït correctament!");
        return 0;
    }
}

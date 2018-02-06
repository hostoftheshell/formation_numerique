<?php

use Illuminate\Database\Seeder;
use App\Category;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Suppression préalable de toutes les images avt le seeder des données
        Storage::disk('local')->delete(Storage::allFiles());
        
        //création des categories pour les posts
        App\Category::create(
            ['name' => 'Front-End D&eacute;veloppeur']
        );
        App\Category::create(
            ['name' => 'Coach de robots']
        );
        App\Category::create(
            ['name' => 'Ing&eacute;nieur en IA']
        );
        App\Category::create(
            ['name' => 'Vid&eacute;aste jeux vidéos']
        );
        // création de 15 posts à partir de la factory
        factory(App\Post::class, 15)->create()->each(
            function ($post) {
                // association d'une category et d'un post
                $category = App\Category::find(rand(1, 4));
                
                $post->category()->associate($category);
                $post->save(); // sauvegarde de l'association dans la base de donnée
                // ajout des images
                // http://lorempicsum.com/#nemo
                $link = str_random(12) . '.jpg'; // hash de lien pour la sécurité
                $file = file_get_contents('http://lorempicsum.com/up/250/250/' . rand(1, 9));
                Storage::disk('local')->put($link, $file);

                $post->picture()->create(
                    ['title' => 'Default',
                    'link' => $link,]
                );
            }
        );
    }
}

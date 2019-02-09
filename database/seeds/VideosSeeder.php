<?php

use App\Course;
use App\Video;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class VideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $faker->addProvider(new Faker\Provider\Youtube($faker));
        \Bezhanov\Faker\ProviderCollectionHelper::addAllProvidersTo($faker);


        $courses = Course::all();

        foreach ($courses as $course) {

            for ($i = 0; $i < 40; $i++) {

                $courseVideos[] = [
                    'course_id' => $course->id,
                    'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'path' => $faker->youtubeEmbedUri(),
                ];
            };

            $videos[] = $courseVideos;
        }

        Video::insert($videos);
    }
}

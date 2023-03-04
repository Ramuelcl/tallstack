<?php

namespace Database\Factories\Backend;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Backend\UserSetting;

class UserSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $theme = implode($this->faker->randomElements($array = ['dark', 'light', 'medium'], $count = 1)); // array('dark')
        $language = implode($this->faker->randomElements($array = ['fr-FR', 'es-ES', 'en-EN'], $count = 1));
        $autologin = $this->faker->boolean($chanceOfGettingTrue = 70);

        // dd([$theme, $language, $autologin]);

        return [
            'theme' => $theme, // array('dark')
            'language' => $language,
            'autologin' => $autologin,
        ];
    }
}

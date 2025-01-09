<?php

namespace App\Traits;

trait putSocialLinksTrait
{
    protected function putSocialLink($social)
    {
        $baseLinks = [
            'tg' => 'https://t.me/',
            'vk' => 'https://vk.com/',
            'inst' => 'https://www.instagram.com/'
        ];

        // Массив для обновления полей
        $updatedFields = [];

        foreach ($baseLinks as $key => $baseLink) {

            $value = $social->$key;

            if ($value === null || $value === '') {
                // Если значение null
            } else {
                if ($key === 'tg') {

                    $value = ltrim($value, '@');
                }

                if (strpos($value, $baseLink) === 0) {
                    // Значение уже начинается с базовой ссылки
                } else {
                    $value = $baseLink . ltrim($value, '/');
                }
            }
            $updatedFields[$key] = $value;
        }
        foreach ($updatedFields as $key => $updatedValue) {

            $social->$key = $updatedValue;
        }

        return (object)$updatedFields; // Преобразуем массив в объект
    }
}

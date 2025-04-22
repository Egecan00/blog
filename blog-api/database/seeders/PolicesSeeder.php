<?php

namespace Database\Seeders;

use App\Models\PrivacyPolicy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class PolicesSeeder extends Seeder
{
    public function run(): void
    {
        PrivacyPolicy::create([
            'type' => 'kvkk',
                'name' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facere voluptatibus dolores ipsam obcaecati ratione similique odit a suscipit quas ex optio magnam dolorem natus dolor, magni rem omnis ducimus porro!
Id ex fugit quisquam non commodi pariatur ullam cupiditate deleniti sunt quas. Harum officiis excepturi tempora sed, incidunt ipsam dolorem dolores totam facere eum, dolor inventore exercitationem impedit quae error!
Laudantium voluptatem inventore placeat exercitationem porro at magni voluptatum quis cumque obcaecati neque nobis soluta itaque reiciendis quasi repellat laborum, provident, recusandae error vitae? Incidunt id molestias nesciunt amet suscipit.
Laborum porro, quo quis ipsa minima doloribus nisi, sunt dolorem explicabo nemo maxime? Temporibus, suscipit natus optio asperiores cupiditate voluptatum, exercitationem consectetur repellat quibusdam, atque possimus? Pariatur voluptatibus optio odit!
Iusto, ex voluptates? Perspiciatis explicabo laborum nesciunt minus dolore delectus omnis, exercitationem nulla reiciendis modi. Praesentium quisquam quod fuga ab, laudantium error, distinctio quaerat culpa ut cum sit illo repudiandae.'
        ]);

        PrivacyPolicy::create([
            'type' => 'privacy_policy',
            'name' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Facere voluptatibus dolores ipsam obcaecati ratione similique odit a suscipit quas ex optio magnam dolorem natus dolor, magni rem omnis ducimus porro!
Id ex fugit quisquam non commodi pariatur ullam cupiditate deleniti sunt quas. Harum officiis excepturi tempora sed, incidunt ipsam dolorem dolores totam facere eum, dolor inventore exercitationem impedit quae error!
Laudantium voluptatem inventore placeat exercitationem porro at magni voluptatum quis cumque obcaecati neque nobis soluta itaque reiciendis quasi repellat laborum, provident, recusandae error vitae? Incidunt id molestias nesciunt amet suscipit.
Laborum porro, quo quis ipsa minima doloribus nisi, sunt dolorem explicabo nemo maxime? Temporibus, suscipit natus optio asperiores cupiditate voluptatum, exercitationem consectetur repellat quibusdam, atque possimus? Pariatur voluptatibus optio odit!
Iusto, ex voluptates? Perspiciatis explicabo laborum nesciunt minus dolore delectus omnis, exercitationem nulla reiciendis modi. Praesentium quisquam quod fuga ab, laudantium error, distinctio quaerat culpa ut cum sit illo repudiandae.'
        ]);
    }
}
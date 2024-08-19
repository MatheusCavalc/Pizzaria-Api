<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Info;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'super_admin' => 1,
            'is_admin' => 1,
        ]);

        $infos = [
            'store_open' => 1,
            'whatsapp_number' => '5585996325360',
            'address' => 'Rua Estado Do Rio, 1112 - Demócrito Rocha',
            'open_days' => 'Segunda a Domingo',
            'opening_hours' => '18:00 às 01:00',
            'social_links' => [
                [
                    'social' => 'Instagram',
                    'link' => 'https://instagram.com/sushiakyy/',
                    'user' => '@sushiakyy',
                ],
                [
                    'social' => 'Facebook',
                    'link' => 'https://www.facebook.com/people/Sushi-aky/61559616506599/',
                    'user' => 'Sushi-aky',
                ],
            ],
        ];

        Info::create($infos);

        $categories = [
            ['name' => 'Pizzas', 'description' => 'description', 'location' => null,],
            ['name' => 'Calzones', 'description' => 'description', 'location' => null,],
            ['name' => 'Meia Pizza', 'description' => 'description', 'location' => null,], //3
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $products = [
            //1
            [
                'name' => 'Pizza de Mussarela',
                'category_id' => 1,
                'link_image' => 'https://caldobom.com.br/uploads/2017/07/pizza-mussarela.jpg',
                'description' => 'Pizza clássica com queijo mussarela derretido',
                'price' => '25.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Pizza de Pepperoni',
                'category_id' => 1,
                'link_image' => 'https://media.istockphoto.com/id/521403691/pt/foto/quente-feito-em-casa-pizza-de-pepperoni.jpg?s=612x612&w=0&k=20&c=KWGroPbutn4ruhgedMeQ6vvPhFULRrnCMtV5coxr1AI=',
                'description' => 'Pizza com pepperoni picante e queijo derretido',
                'price' => '28.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Pizza de Margherita',
                'category_id' => 1,
                'link_image' => 'https://anamariabraga.globo.com/wp-content/uploads/2020/08/pizza-margherita.jpg',
                'description' => 'Pizza com molho de tomate, mussarela e manjericão',
                'price' => '26.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Pizza de Calabresa',
                'category_id' => 1,
                'link_image' => 'https://cdn0.tudoreceitas.com/pt/posts/9/8/3/pizza_calabresa_e_mussarela_4389_600.jpg',
                'description' => 'Pizza com calabresa, queijo e cebola',
                'price' => '27.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Pizza de Chocolate',
                'category_id' => 1,
                'link_image' => 'https://www.sabornamesa.com.br/media/k2/items/cache/14985840dca330e3b808aa792fa422f9_XL.jpg',
                'description' => 'Pizza doce com chocolate derretido e morangos',
                'price' => '22.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Pizza de Frango com Catupiry',
                'category_id' => 1,
                'link_image' => 'https://receitasdepesos.com.br/wp-content/uploads/2023/09/pizza-de-frango.jpg',
                'description' => 'Pizza com frango desfiado, catupiry e temperos especiais',
                'price' => '28.50',
                'quantity' => 0,
                'on_sale' => 1,
            ],
            [
                'name' => 'Pizza Vegetariana',
                'category_id' => 1,
                'link_image' => 'https://receitasdepesos.com.br/wp-content/uploads/2023/09/pizza-de-frango.jpg',
                'description' => 'Pizza recheada com uma variedade de legumes frescos e queijo derretido',
                'price' => '26.90',
                'quantity' => 0,
                'on_sale' => 1,
            ],
            [
                'name' => 'Pizza Quatro Queijos',
                'category_id' => 1,
                'link_image' => 'https://www.sabornamesa.com.br/media/k2/items/cache/32699af76cfc6e0191d612ffd4e88ee9_XL.jpg',
                'description' => 'Pizza com uma deliciosa combinação de quatro queijos diferentes',
                'price' => '29.90',
                'quantity' => 0,
                'on_sale' => 1,
            ],

            //2
            [
                'name' => 'Calzone',
                'category_id' => 2,
                'link_image' => 'https://www.receiteria.com.br/wp-content/uploads/calzone-24-730x548.jpeg',
                'description' => 'Além do queijo, o recheio dessa massa também leva molho de tomate e um toque de orégano',
                'price' => '25.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Calzone de bacon e cogumelos',
                'category_id' => 2,
                'link_image' => 'https://www.jocooks.com/wp-content/uploads/2011/08/bacon-and-mushroom-calzone-1-500x500.jpg',
                'description' => 'Além de bacon e cogumelos, essa massa também é recheada com queijo.',
                'price' => '28.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Calzone de carne de porco',
                'category_id' => 2,
                'link_image' => 'http://www.receiteria.com.br/wp-content/uploads/receitas-de-calzone-3-747x482.jpg',
                'description' => 'Massa mais encorpada com recheio de carne de porco',
                'price' => '26.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Calzone de camarão',
                'category_id' => 2,
                'link_image' => 'https://portalsabores.com.br/wp-content/uploads/2014/10/receita-de-calzone-de-camarao.jpg',
                'description' => 'Se você gosta de frutos do mar, que tal experimentar essa receita? Para acompanhar o camarão, você confere o preparo de um molho muito saboroso.',
                'price' => '27.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Calzone de bacon e queijos',
                'category_id' => 2,
                'link_image' => 'https://cdn0.tudoreceitas.com/pt/posts/2/8/8/calzone_de_presunto_e_queijo_3882_orig.jpg',
                'description' => 'Bacon, cogumelos, fiambre, 2 queijos e azeitonas pretas são usados para rechear essa massa.',
                'price' => '22.90',
                'quantity' => 0,
            ],

            //3
            [
                'name' => 'Mussarela',
                'category_id' => 3,
                'link_image' => 'https://caldobom.com.br/uploads/2017/07/pizza-mussarela.jpg',
                'description' => 'Mussarela é uma deliciosa meia pizza com queijo derretido e molho de tomate.',
                'price' => '10.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Calabresa',
                'category_id' => 3,
                'link_image' => 'https://cdn0.tudoreceitas.com/pt/posts/9/8/3/pizza_calabresa_e_mussarela_4389_600.jpg',
                'description' => 'Calabresa é uma meia pizza com fatias de calabresa, queijo e molho de tomate.',
                'price' => '10.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Mista',
                'category_id' => 3,
                'link_image' => 'https://www.picanhacia.com.br/wp-content/uploads/2017/01/Pizza_quatro_queijossss-2.jpg',
                'description' => 'Mista é uma meia pizza com uma combinação de ingredientes, incluindo queijo, presunto e outros.',
                'price' => '10.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Dois Queijos',
                'category_id' => 3,
                'link_image' => 'https://claudia.abril.com.br/wp-content/uploads/2020/02/receita-pizza-caseira-dois-queijos.jpg',
                'description' => 'Dois queijos é uma meia pizza com uma mistura de dois tipos de queijo derretido e molho de tomate.',
                'price' => '10.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Quatro Queijos',
                'category_id' => 3,
                'link_image' => 'https://www.sabornamesa.com.br/media/k2/items/cache/32699af76cfc6e0191d612ffd4e88ee9_XL.jpg',
                'description' => 'Quatro queijos é uma meia pizza com uma seleção de quatro queijos derretidos e molho de tomate.',
                'price' => '10.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Marguerita',
                'category_id' => 3,
                'link_image' => 'https://anamariabraga.globo.com/wp-content/uploads/2020/08/pizza-margherita.jpg',
                'description' => 'Marguerita é uma meia pizza com tomate, manjericão, queijo e molho de tomate.',
                'price' => '10.90',
                'quantity' => 0,
            ],

            [
                'name' => 'Chocolate',
                'category_id' => 3,
                'link_image' => 'https://www.sabornamesa.com.br/media/k2/items/cache/14985840dca330e3b808aa792fa422f9_XL.jpg',
                'description' => 'Chocolate é uma meia pizza com cobertura de chocolate derretido e ingredientes doces.',
                'price' => '10.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Milho',
                'category_id' => 3,
                'link_image' => 'https://img.freepik.com/fotos-premium/close-up-de-uma-pizza-de-milho-com-borda-recheada-em-uma-mesa-de-madeira-clara_311379-1220.jpg?w=2000',
                'description' => 'Milho é uma meia pizza com milho, queijo e molho de tomate.',
                'price' => '10.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Portuguesa',
                'category_id' => 3,
                'link_image' => 'https://i.pinimg.com/736x/ce/a5/b5/cea5b566a812aba7c0bb631d4bd5d4fb.jpg',
                'description' => 'Portuguesa é uma meia pizza com uma combinação especial de ingredientes.',
                'price' => '10.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Toscana',
                'category_id' => 3,
                'link_image' => 'https://blog.novasafra.com.br/wp-content/uploads/2019/01/toscana-700x450.jpeg',
                'description' => 'Toscana é uma meia pizza com ingredientes típicos da culinária toscana, incluindo linguiça e outros.',
                'price' => '10.90',
                'quantity' => 0,
            ],
            [
                'name' => 'Banana',
                'category_id' => 3,
                'link_image' => 'https://www.designi.com.br/images/preview/10072871.jpg',
                'description' => 'Banana é uma meia pizza doce com fatias de banana e cobertura doce.',
                'price' => '10.90',
                'quantity' => 0,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

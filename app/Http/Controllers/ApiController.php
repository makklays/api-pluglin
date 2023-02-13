<?php 
/**
 * Author: Alexander Kuziv
 * E-mail: hola.kuziv@gmail.com 
 * Fecha: 10.02.2023 
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;
use App\Models\Idioma;
use App\Models\Contenido;
use App\Services\Content; 
 
class ApiController extends Controller
{
    // la lista de categorias 
    public function all_categorias()
    {
        $content = new Content();
        $res = $content->url_request('http://52.47.124.82/config'); // , 10, 0

        $arr_tmp = [];
        if (!empty($res) && !empty($res->categories)) {
            foreach($res->categories as $item) {
                $arr_tmp[$item] = $item;
            }
        } 

        //dd($arr_tmp);

        return response()->json(['data' => $arr_tmp], 200);
    }

    // la lista de los textos por categoria 
    public function categoria(Request $request, $categoria)
    {
        $content = new Content();
        $res = $content->url_request('http://52.47.124.82/contents'); // , 10, 0

        $arr_tmp = [];
        if (!empty($res)) {
            foreach($res as $item) {
                //dd($item->category, $categoria);

                if ($item->category == $categoria) {
                    $arr_tmp[$item->name.'_'.$item->language] = [
                        'category' => $item->category,
                        'name' => $item->name,
                        'body' => $item->body,
                        'language' => $item->language,
                    ];

                    // proba Categoria 
                    /*$cat = Categoria::where(['title' => $categoria])->first();
                    if (empty($cat)) {
                        $cat = Categoria::create([
                            'title' => $categoria
                        ]);
                    }

                    // proba Idioma 
                    $idioma = Idioma::where(['title' => $item->language])->first();
                    if (empty($idioma)) {
                        $idioma = Idioma::create([
                            'title' => $item->language
                        ]);
                    }

                    // Contenido 
                    $texto = Contenido::create([
                        'categoria_id' => $cat->id,
                        'idioma_id' => $idioma->id,
                        'name' => $item->name,
                        'body' => $item->body,
                    ]);*/

                    if (!empty($item->translations)) {
                        foreach($item->translations as $k => $v) {
                            $arr_tmp[$item->name.'_'.$k] = [
                                'category' => $item->category,
                                'name' => $item->name,
                                'body' => $v,
                                'language' => $k,
                            ];

                            // proba Idioma 
                            /*$idioma = Idioma::where(['title' => $k])->first();
                            if (empty($idioma)) {
                                $idioma = Idioma::create([
                                    'title' => $k
                                ]);
                            }

                            // Contenido 
                            $texto = Contenido::create([
                                'categoria_id' => $cat->id,
                                'idioma_id' => $idioma->id,
                                'name' => $item->name,
                                'body' => $v,
                            ]);*/
                        }
                    }
                }
            }
        } 

        //dd(count($arr_tmp), $arr_tmp);

        return response()->json(['data' => $arr_tmp], 200);
    }

    // la lista de idiomas
    public function all_idiomas()
    {
        $content = new Content();
        $res = $content->url_request('http://52.47.124.82/config'); // , 10, 0

        $arr_tmp = [];
        if (!empty($res) && !empty($res->languages)) {
            foreach($res->languages as $item) {
                // source 
                if (!empty($item) && !is_array($item)) {
                    $arr_tmp[$item] = $item;
                }
                // destinations 
                if (!empty($item) && is_array($item)) {
                    foreach($item as $it) {
                        $arr_tmp[$it] = $it;
                    }
                }
            }
        } 

        //dd($arr_tmp);

        return response()->json(['data' => $arr_tmp], 200);
    }

    // la lista de los textos por idioma 
    public function idioma(Request $request, $idioma)
    {
        $content = new Content();
        $res = $content->url_request('http://52.47.124.82/contents'); // , 10, 0

        $arr_tmp = [];
        if (!empty($res)) {
            foreach($res as $item) {
                //dd($item->language, $idioma);

                if ($item->language == $idioma) {
                    $arr_tmp[$item->name.'_'.$item->language] = [
                        'language' => $item->language,
                        'category' => $item->category,
                        'name' => $item->name,
                        'body' => $item->body,
                    ];

                    // proba Categoria 
                    /*$cat = Categoria::where(['title' => $item->category])->first();
                    if (empty($cat)) {
                        $cat = Categoria::create([
                            'title' => $item->category
                        ]);
                    }

                    // proba Idioma 
                    $idioma = Idioma::where(['title' => $item->language])->first();
                    if (empty($idioma)) {
                        $idioma = Idioma::create([
                            'title' => $item->language
                        ]);
                    }

                    // Contenido 
                    $texto = Contenido::create([
                        'categoria_id' => $cat->id,
                        'idioma_id' => $idioma->id,
                        'name' => $item->name,
                        'body' => $item->body,
                    ]);*/
                }

                if (!empty($item->translations)) {
                    foreach($item->translations as $k => $v) {

                        if ($k == $idioma) {
                            $arr_tmp[$item->name.'_'.$k] = [
                                'language' => $k,
                                'category' => $item->category,
                                'name' => $item->name,
                                'body' => $v,
                            ];
                        } 

                        // proba Categoria 
                        /*$cat = Categoria::where(['title' => $item->category])->first();
                        if (empty($cat)) {
                            $cat = Categoria::create([
                                'title' => $item->category
                            ]);
                        }

                        // proba Idioma 
                        $idioma = Idioma::where(['title' => $k])->first();
                        if (empty($idioma)) {
                            $idioma = Idioma::create([
                                'title' => $k
                            ]);
                        }

                        // Contenido 
                        $texto = Contenido::create([
                            'categoria_id' => $cat->id,
                            'idioma_id' => $idioma->id,
                            'name' => $item->name,
                            'body' => $v,
                        ]);*/
                    }
                }
            }
        }

        //dd($arr_tmp);

        return response()->json(['data' => $arr_tmp], 200);
    } 
}


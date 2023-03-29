<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;

    public function tampil()
    {
        $file = public_path() . "/assets/db/items.json";
        $anggota = file_get_contents($file);
        $data = json_decode($anggota, true);
        return $data;
    }

    public function hapus($id)
    {
        $file = public_path() . "/assets/db/items.json";
        $anggota = file_get_contents($file);
        $data = json_decode($anggota, true);
        foreach ($data as $key => $d) {
            if ($d['id'] == $id) {
                array_splice($data, $key, 1);
            }
        }
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $anggota = file_put_contents($file, $jsonfile);
    }

    public function tambah($data_baru)
    {
        $file = public_path() . "/assets/db/items.json";
        $anggota = file_get_contents($file);
        $data = json_decode($anggota, true);
        $data[] = $data_baru;
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $anggota = file_put_contents($file, $jsonfile);
    }

    public function edit($id, $data_baru)
    {
        $file = public_path() . "/assets/db/items.json";
        $anggota = file_get_contents($file);
        $data = json_decode($anggota, true);
        foreach ($data as $key => $d) {
            if ($d['id'] == $id) {
                if (isset($data_baru['title'])) {
                    $data[$key]['title'] = $data_baru['title'];
                }
                if (isset($data_baru['price'])) {
                    $data[$key]['price'] = $data_baru['price'];
                }
                if (isset($data_baru['category'])) {
                    $data[$key]['category'] = $data_baru['category'];
                }
                if (isset($data_baru['marker_image'])) {
                    $data[$key]['marker_image'] = $data_baru['marker_image'];
                }
                if (isset($data_baru['url'])) {
                    $data[$key]['url'] = $data_baru['url'];
                }
                if (isset($data_baru['address'])) {
                    $data[$key]['address'] = $data_baru['address'];
                }
                if (isset($data_baru['latitude'])) {
                    $data[$key]['latitude'] = $data_baru['latitude'];
                }
                if (isset($data_baru['longitude'])) {
                    $data[$key]['longitude'] = $data_baru['longitude'];
                }
            }
        }
        $jsonfile = json_encode($data, JSON_PRETTY_PRINT);
        $anggota = file_put_contents($file, $jsonfile);
    }

    public function cekrekomendasi($data)
    {
        $rec = $data;
        if ($rec->jenistanah == 'lebur') {
            if (($rec->suhu >= 15) and ($rec->suhu < 20)) {
                if ($rec->tinggi > 1) {
                    $rekomendasi = [
                        'title' => 'cabai',
                        'image' => 'https:\/\/images.unsplash.com\/photo-1656690446569-57b818d4e10c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'
                    ];
                    return $rekomendasi;
                }
            } else {
                $rekomendasi = [
                    'title' => 'cabai',
                    'image' => 'https:\/\/images.unsplash.com\/photo-1656690446569-57b818d4e10c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'
                ];
                return $rekomendasi;
            }
            $rekomendasi = [
                'title' => 'tomat',
                'image' => 'https:\/\/img.freepik.com\/free-photo\/tomatoes_1232-1910.jpg?w=1060&t=st=1664467140~exp=1664467740~hmac=3b06ce48a79ad4be168d93f5e83b42500bad6a8fa3653a5c7bcd2449776633e6'
            ];
            return $rekomendasi;
        }
    }
}
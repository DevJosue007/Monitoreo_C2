<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CatalogItem;

class CatalogItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // --------------------- catálogo: centros_penitenciarios -----------------------
        // ---------------------------------------------------------------------------
        CatalogItem::create([
            'definicion'    => 'centros_penitenciarios', 
            'item_etiqueta' => 'Centro Penitenciario de Alta Seguridad Para Delito de Alto Impacto', 
            'item_valor'    => 'cp_01', 
            'estatus'       => true
        ]);
        CatalogItem::create([
            'definicion'    => 'centros_penitenciarios', 
            'item_etiqueta' => 'Centro Federal de Readaptación Social (CEFERESO) No. 17 "CPS Michoacán"', 
            'item_valor'    => 'cp_02', 
            'estatus'       => true
        ]);
        CatalogItem::create([
            'definicion'    => 'centros_penitenciarios', 
            'item_etiqueta' => 'Unidad Especializada para Adolescentes y Adultos Jóvenes', 
            'item_valor'    => 'cp_03', 
            'estatus'       => true
        ]);
        CatalogItem::create([
            'definicion'    => 'centros_penitenciarios', 
            'item_etiqueta' => 'Centro Estal Morelia', 
            'item_valor'    => 'cp_04', 
            'estatus'       => true
        ]);    
        CatalogItem::create([
            'definicion'    => 'centros_penitenciarios', 
            'item_etiqueta' => 'Centro Estal La Piedad', 
            'item_valor'    => 'cp_05', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'centros_penitenciarios', 
            'item_etiqueta' => 'Centro Estal Uruapan', 
            'item_valor'    => 'cp_06', 
            'estatus'       => true
        ]);      
        CatalogItem::create([
            'definicion'    => 'centros_penitenciarios', 
            'item_etiqueta' => 'Centro Estal Zitácuaro', 
            'item_valor'    => 'cp_07', 
            'estatus'       => true
        ]); 
        CatalogItem::create([
            'definicion'    => 'centros_penitenciarios', 
            'item_etiqueta' => 'Centro Estal Zamora', 
            'item_valor'    => 'cp_08', 
            'estatus'       => true
        ]);                                          

        // -------------------------- catálogo: areas -------------------------------
        // ---------------------------------------------------------------------------

        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Mantenimiento', 
            'item_valor'    => 'a_01', 
            'estatus'       => true
        ]);   
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Reciclaje', 
            'item_valor'    => 'a_02', 
            'estatus'       => true
        ]);                                          
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Basurero', 
            'item_valor'    => 'a_03', 
            'estatus'       => true
        ]);                                          
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Almacén', 
            'item_valor'    => 'a_04', 
            'estatus'       => true
        ]);                                          
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Tienda', 
            'item_valor'    => 'a_05', 
            'estatus'       => true
        ]);   
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Área Educativa', 
            'item_valor'    => 'a_06', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Área Espiritual', 
            'item_valor'    => 'a_07', 
            'estatus'       => true
        ]); 
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Biblioteca', 
            'item_valor'    => 'a_08', 
            'estatus'       => true
        ]);      
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Cocina', 
            'item_valor'    => 'a_09', 
            'estatus'       => true
        ]); 
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Área Médica', 
            'item_valor'    => 'a_10', 
            'estatus'       => true
        ]);
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Área de Visita Íntima', 
            'item_valor'    => 'a_11', 
            'estatus'       => true
        ]);                                                                                                          
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Módulo de Atención Especial (COC, CU)', 
            'item_valor'    => 'a_12', 
            'estatus'       => true
        ]);     
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Módulos', 
            'item_valor'    => 'a_13', 
            'estatus'       => true
        ]);     
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Área Infantil', 
            'item_valor'    => 'a_14', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Comedor ', 
            'item_valor'    => 'a_15', 
            'estatus'       => true
        ]);        
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Talleres', 
            'item_valor'    => 'a_16', 
            'estatus'       => true
        ]);                                                                                                                                        
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Áreas Deportivas', 
            'item_valor'    => 'a_17', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Áreas de visita', 
            'item_valor'    => 'a_18', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Áreas Verdes', 
            'item_valor'    => 'a_19', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Vigilancia y control', 
            'item_valor'    => 'a_20', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Perímetro', 
            'item_valor'    => 'a_21', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Torres de vigilancia', 
            'item_valor'    => 'a_22', 
            'estatus'       => true
        ]);       
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Pluma o acceso Principal', 
            'item_valor'    => 'a_23', 
            'estatus'       => true
        ]);        
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Estacionamiento', 
            'item_valor'    => 'a_24', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Aduana vehicular o Transfer', 
            'item_valor'    => 'a_25', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Gobierno', 
            'item_valor'    => 'a_26', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'areas', 
            'item_etiqueta' => 'Área de revisión', 
            'item_valor'    => 'a_27', 
            'estatus'       => true
        ]);  


        // -------------------------- catálogo: bloques -----------------------------
        // ---------------------------------------------------------------------------

        CatalogItem::create([
            'definicion'    => 'bloques', 
            'item_etiqueta' => 'Control y Gestión', 
            'item_valor'    => 'a_01', 
            'estatus'       => true 
        ]);  
        CatalogItem::create([
            'definicion'    => 'bloques', 
            'item_etiqueta' => 'Convivencia', 
            'item_valor'    => 'a_02', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'bloques', 
            'item_etiqueta' => 'Salud y visitas', 
            'item_valor'    => 'a_03', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'bloques', 
            'item_etiqueta' => 'Enseñanza y aprendizaje', 
            'item_valor'    => 'a_04', 
            'estatus'       => true
        ]);      
        CatalogItem::create([
            'definicion'    => 'bloques', 
            'item_etiqueta' => 'Servicios', 
            'item_valor'    => 'a_05', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'bloques', 
            'item_etiqueta' => 'Custodia', 
            'item_valor'    => 'a_06', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'bloques', 
            'item_etiqueta' => 'Operaciones', 
            'item_valor'    => 'a_07', 
            'estatus'       => true
        ]);  

        
        // -------------------------- catálogo: areas -------------------------------
        // ---------------------------------------------------------------------------

        CatalogItem::create([
            'definicion'    => 'tipos_inc', 
            'item_etiqueta' => 'Bajo', 
            'item_valor'    => 'ti_01', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'tipos_inc', 
            'item_etiqueta' => 'Moderado', 
            'item_valor'    => 'ti_02', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'tipos_inc', 
            'item_etiqueta' => 'Alto', 
            'item_valor'    => 'ti_03', 
            'estatus'       => true
        ]);  
        CatalogItem::create([
            'definicion'    => 'tipos_inc', 
            'item_etiqueta' => 'Crítico', 
            'item_valor'    => 'ti_04', 
            'estatus'       => true
        ]);  


    }
}


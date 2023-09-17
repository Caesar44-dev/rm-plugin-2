<div class="container">
    <div class="modal fade" id="importexcelrmmodal" tabindex="-1" aria-labelledby="importexcelrmmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="formm" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="importexcelrmmodalLabel">Importar CSV</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="archivo_csv" id="archivo_csv">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" id="buttonimportexcelrm" name="buttonimportexcelrm" class="btn btn-primary">Importar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php
    echo "<h1 class='wp-heading-inline title'>" . get_admin_page_title() . "</h1>";
    echo '<button type="button" class="button button-secondary" onclick="openModalCreate(\'importexcelrmmodal\')">Importar Excel</button>';

    global $wpdb;
    $table_rm_plugin = $wpdb->prefix . 'rm_plugin';

    if (isset($_POST["buttonimportexcelrm"])) {
        if (isset($_FILES["archivo_csv"])) {
            $file = $_FILES["archivo_csv"];

            $fileType = pathinfo($file["name"], PATHINFO_EXTENSION);
            if ($fileType == "csv") {
                $csvData = array_map('str_getcsv', file($file["tmp_name"]));

                if (!empty($csvData)) {
                    foreach ($csvData as $row) {
                        $guid = $row[0];
                        $buscar = $row[1];
                        $sustituir = $row[2];

                        $wpdb->query(
                            $wpdb->prepare(
                                "UPDATE {$wpdb->prefix}posts
                                SET post_content = REPLACE(post_content, %s, %s),
                                    post_title = REPLACE(post_title, %s, %s),
                                    post_name = REPLACE(post_name, %s, %s)
                                WHERE guid = %s",
                                $buscar,
                                $sustituir,
                                $buscar,
                                $sustituir,
                                $buscar,
                                $sustituir,
                                $guid
                            )
                        );

                        $wpdb->insert(
                            $table_rm_plugin,
                            array(
                                'guid' => $guid,
                                'buscar' => $buscar,
                                'sustituir' => $sustituir
                            )
                        );
                    }

                    echo '</br>';
                    echo 'Búsqueda y reemplazo completados.';
                    echo '</br>';
                } else {
                    echo '</br>';
                    echo 'El archivo CSV está vacío.';
                    echo '</br>';
                }
            } else {
                echo '</br>';
                echo "El archivo debe ser un CSV.";
                echo '</br>';
            }
        } else {
            echo '</br>';
            echo "No se seleccionó ningún archivo.";
            echo '</br>';
        }
    }
    ?>
</div>
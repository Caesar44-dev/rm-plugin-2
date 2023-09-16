<div class="container">
    <div class="modal fade" id="creatermmodal" tabindex="-1" aria-labelledby="creatermmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="formm" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="creatermmodalLabel">Crear</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="buscar" id="buscar" value="">
                        <input type="text" name="sustituir" id="sustituir" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" id="buttoncreaterm" name="buttoncreaterm" class="btn btn-primary">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="modal fade" id="updatermmodal" tabindex="-1" aria-labelledby="updatermmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="formm" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updatermmodalLabel">Actualizar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="id" id="id" value="">
                        <input type="text" name="buscar" id="buscar" value="">
                        <input type="text" name="sustituir" id="sustituir" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" id="buttonupdaterm" name="buttonupdaterm" class="btn btn-warning">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="modal fade" id="deletermmodal" tabindex="-1" aria-labelledby="deletermmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="formm" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deletermmodalLabel">Eliminar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="id" id="id" value="">
                        <input type="text" name="buscar" id="buscar" value="">
                        <input type="text" name="sustituir" id="sustituir" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" id="buttondeleterm" name="buttondeleterm" class="btn btn-danger">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <?php
    echo "<h1 class='wp-heading-inline title'>" . get_admin_page_title() . "</h1>";
    echo '<button type="button" class="button button-secondary" onclick="openModalCreate(\'creatermmodal\')">Añadir nuevo RM</button>';

    global $wpdb;
    $table_rm_plugin = $wpdb->prefix . 'rm_plugin';

    if (isset($_POST['buttoncreaterm'])) {
        $buscar = $_POST['buscar'];
        $sustituir = $_POST['sustituir'];

        global $wpdb;
        $table_rm_plugin = $wpdb->prefix . 'rm_plugin';

        $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->prefix}posts
                SET post_content = REPLACE(post_content, %s, %s),
                    post_title = REPLACE(post_title, %s, %s),
                    post_name = REPLACE(post_name, %s, %s)
                WHERE post_type = 'post'",
                $buscar,
                $sustituir,
                $buscar,
                $sustituir,
                $buscar,
                $sustituir
            )
        );

        $wpdb->insert(
            $table_rm_plugin,
            array(
                'Buscar' => $buscar,
                'Sustituir' => $sustituir
            )
        );

        echo 'Búsqueda y reemplazo completados.';
    }
    
    if (isset($_POST['buttonupdaterm'])) {

        $id = $_POST['id'];

        $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_rm_plugin WHERE ID = %d", $id));

        if ($result) {
            $buscar = $_POST['buscar'];
            $sustituir = $_POST['sustituir'];

            // Actualizar la tabla posts
            $table_posts = $wpdb->prefix . 'posts';
            $wpdb->query(
                $wpdb->prepare(
                    "UPDATE $table_posts
                    SET post_content = REPLACE(post_content, %s, %s)
                    WHERE post_content LIKE %s",
                    $buscar,
                    $sustituir,
                    '%' . $buscar . '%'
                )
            );

            $wpdb->update(
                $table_rm_plugin,
                array(
                    'Buscar' => $buscar,
                    'Sustituir' => $sustituir
                ),
                array(
                    'ID' => $id
                )
            );

            echo 'Actualización completada.';
        }
    }

    if (isset($_POST['buttondeleterm'])) {
        $id = $_POST['id'];
        $buscar = $_POST['buscar'];
        $sustituir = $_POST['sustituir'];

        $wpdb->delete(
            $table_rm_plugin,
            array(
                'ID' => $id
            )
        );

        echo 'Eliminación completada.';

        $wpdb->update(
            $table_rm_plugin,
            array(
                'Buscar' => $sustituir,
                'Sustituir' => $buscar
            ),
            array(
                'Buscar' => $buscar,
                'Sustituir' => $sustituir
            )
        );

        echo 'Actualización completada.';
    }

    $results = $wpdb->get_results("SELECT * FROM {$table_rm_plugin}");
    if (!empty($results)) {
        echo '<div class="tablee">';
        echo '<table class="wp-list-table widefat striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Buscar</th>';
        echo '<th>Sustituir</th>';
        echo '<th>Editar</th>';
        echo '<th>Borrar</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($results as $result) {
            echo '<tr>';
            echo '<td>' . $result->Buscar . '</td>';
            echo '<td>' . $result->Sustituir . '</td>';
            echo '<td>';
            echo '<button type="button" class="button button-secondary" onclick="openModalUpdate(\'updatermmodal\', \'' . $result->ID . '\', \'' . $result->Buscar . '\', \'' . $result->Sustituir . '\')">Editar</button>';
            echo '</td>';
            echo '<td>';
            echo '<button type="button" class="button button-secondary" onclick="openModalDelete(\'deletermmodal\', \'' . $result->ID . '\', \'' . $result->Buscar . '\', \'' . $result->Sustituir . '\')">Eliminar</button>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        echo 'No hay registros encontrados.';
    }

    ?>
</div>
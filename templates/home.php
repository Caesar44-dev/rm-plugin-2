<div class="container">
    <div class="modal fade" id="creatermmodal" tabindex="-1" aria-labelledby="creatermmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="formm" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="creatermmodalLabel">Crear RM</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="guid" id="guid" value="" placeholder="Guid">
                        <input type="text" name="buscar" id="buscar" value="" placeholder="Buscar">
                        <input type="text" name="sustituir" id="sustituir" value="" placeholder="Sustituir">
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

<!-- <div class="container">
    <div class="modal fade" id="updatermmodal" tabindex="-1" aria-labelledby="updatermmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="formm" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updatermmodalLabel">Actualizar RM</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" disabled name="id" id="id" value="">
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
</div> -->

<div class="container">
    <div class="modal fade" id="deletermmodal" tabindex="-1" aria-labelledby="deletermmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="formm" method="post">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deletermmodalLabel">Eliminar RM</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="id" id="id" value="">
                        <input type="text" name="guid" id="guid" value="">
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
    echo '<button type="button" class="button button-secondary" onclick="openModalCreate(\'creatermmodal\')">Añadir Nuevo RM</button>';

    global $wpdb;
    $table_rm_plugin = $wpdb->prefix . 'rm_plugin';

    if (isset($_POST['buttoncreaterm'])) {
        $guid = $_POST['guid'];
        $buscar = $_POST['buscar'];
        $sustituir = $_POST['sustituir'];

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
                $guid,
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

        echo '</br>';
        echo 'Búsqueda y reemplazo completados.';
        echo '</br>';
    }

    // if (isset($_POST['buttonupdaterm'])) {

    //     $id = $_POST['id'];

    //     $result = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_rm_plugin WHERE ID = %d", $id));

    //     if ($result) {
    //         $buscar = $_POST['buscar'];
    //         $sustituir = $_POST['sustituir'];
    //         $wpdb->query(
    //             $wpdb->prepare(
    //                 "UPDATE {$wpdb->prefix}posts
    //                 SET post_content = REPLACE(post_content, %s, %s),
    //                     post_title = REPLACE(post_title, %s, %s),
    //                     post_name = REPLACE(post_name, %s, %s)
    //                 WHERE post_type = 'post'",
    //                 $buscar,
    //                 $sustituir,
    //                 $buscar,
    //                 $sustituir,
    //                 $buscar,
    //                 $sustituir,
    //             )
    //         );

    //         $wpdb->update(
    //             $table_rm_plugin,
    //             array(
    //                 'Buscar' => $buscar,
    //                 'Sustituir' => $sustituir
    //             ),
    //             array(
    //                 'id' => $id
    //             )
    //         );

    //         echo '</br>';
    //         echo 'Actualización completada.';
    //         echo '</br>';
    //     }
    // }

    if (isset($_POST['buttondeleterm'])) {
        $id = $_POST['id'];
        $guid = $_POST['guid'];
        $buscar = $_POST['buscar'];
        $sustituir = $_POST['sustituir'];

        $wpdb->delete(
            $table_rm_plugin,
            array(
                'id' => $id
            )
        );

        echo '</br>';
        echo 'Eliminación completada.';
        echo '</br>';

        $wpdb->query(
            $wpdb->prepare(
                "UPDATE {$wpdb->prefix}posts
                SET post_content = REPLACE(post_content, %s, %s),
                    post_title = REPLACE(post_title, %s, %s),
                    post_name = REPLACE(post_name, %s, %s)
                    WHERE guid = %s",
                $sustituir,
                $buscar,
                $sustituir,
                $buscar,
                $sustituir,
                $buscar,
                $guid
            )
        );
        echo 'Actualización completada.';
        echo '</br>';
    }

    $results = $wpdb->get_results("SELECT * FROM {$table_rm_plugin}");
    if (!empty($results)) {
        echo '<div class="tablee">';
        echo '<table class="wp-list-table widefat striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>id</th>';
        echo '<th>guid</th>';
        echo '<th>Buscar</th>';
        echo '<th>Sustituir</th>';
        // echo '<th>Editar</th>';
        echo '<th>Borrar</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        foreach ($results as $result) {
            echo '<tr>';
            echo '<td>' . $result->id . '</td>';
            echo '<td>' . $result->guid . '</td>';
            echo '<td>' . $result->buscar . '</td>';
            echo '<td>' . $result->sustituir . '</td>';
            // echo '<td>';
            // echo '<button type="button" class="button button-secondary" onclick="openModalUpdate(\'updatermmodal\', \'' . $result->id . '\', \'' . $result->buscar . '\', \'' . $result->sustituir . '\')">Editar</button>';
            // echo '</td>';
            echo '<td>';
            echo '<button type="button" class="button button-secondary" onclick="openModalDelete(\'deletermmodal\', \'' . $result->id . '\', \'' . $result->guid . '\' , \'' . $result->buscar . '\', \'' . $result->sustituir . '\')">Eliminar</button>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        echo '</br>';
        echo '</br>';
        echo 'No hay registros encontrados.';
        echo '</br>';
        echo '</br>';
    }

    ?>
</div>


<script>
    function openModalCreate(modalId) {
        var modal = document.getElementById(modalId);
        var bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    }

    // function openModalUpdate(modalId, id, buscar, sustituir) {
    //     var modal = document.getElementById(modalId);
    //     var idInput = modal.querySelector('input[name="id"]');
    //     var idInput2 = modal.querySelector('input[name="buscar"]');
    //     var idInput3 = modal.querySelector('input[name="sustituir"]');
    //     idInput.value = id;
    //     idInput2.value = buscar;
    //     idInput3.value = sustituir;
    //     var bsModal = new bootstrap.Modal(modal);
    //     bsModal.show();
    // }

    function openModalDelete(modalId, id, guid, buscar, sustituir) {
        var modal = document.getElementById(modalId);
        var idInput = modal.querySelector('input[name="id"]');
        var idInput2 = modal.querySelector('input[name="guid"]');
        var idInput3 = modal.querySelector('input[name="buscar"]');
        var idInput4 = modal.querySelector('input[name="sustituir"]');
        idInput.value = id;
        idInput2.value = guid;
        idInput3.value = buscar;
        idInput4.value = sustituir;
        var bsModal = new bootstrap.Modal(modal);
        bsModal.show();
    }
</script>
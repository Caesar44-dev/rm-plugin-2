<div class="container">
    <?php
    echo "<h1 class='wp-heading-inline title'>" . get_admin_page_title() . "</h1>";

    global $wpdb;
    $tabla_post = "{$wpdb->prefix}posts";
    $table_rm_plugin = "{$wpdb->prefix}rm_plugin";

    if (isset($_GET['id'])) {
        $update = intval($_GET['id']);

        global $wpdb;

        $result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$table_rm_plugin} WHERE ID = %d",
                $deleteID
            )
        );

        if ($result) {
            $buscar = $result->Buscar;

            $wpdb->query(
                $wpdb->prepare(
                    "DELETE FROM {$table_rm_plugin} WHERE ID = %d",
                    $deleteID
                )
            );

            $wpdb->query(
                $wpdb->prepare(
                    "UPDATE {$wpdb->prefix}posts
                    SET post_content = REPLACE(post_content, %s, %s)
                    WHERE post_type = 'post'",
                    $buscar,
                    $buscar
                )
            );

            $wpdb->query(
                $wpdb->prepare(
                    "UPDATE {$wpdb->prefix}posts
                    SET post_title = REPLACE(post_title, %s, %s)
                    WHERE post_type = 'post'",
                    $buscar,
                    $buscar
                )
            );

            $wpdb->query(
                $wpdb->prepare(
                    "UPDATE {$wpdb->prefix}posts
                    SET post_name = REPLACE(post_name, %s, %s)
                    WHERE post_type = 'post'",
                    $buscar,
                    $buscar
                )
            );

            echo 'Eliminación y restablecimiento completados.';
        }
    }

    ?>
    <div class="wrap">
        <form class="formm" method="post">
            <label for="buscar">Buscar:</label>
            <input type="text" id="buscar" name="buscar" placeholder="Ingrese la palabra a buscar">

            <input type="submit" id="buttonndelete" name="buttonndelete" value="Eliminar">
        </form>
    </div>

    <?php
    global $wpdb;

    $resultados = $wpdb->get_results(
        "SELECT * FROM {$table_rm_plugin}"
    );

    if ($resultados) {
        echo "<h2>Registros existentes:</h2>";
        echo "<ul>";

        foreach ($resultados as $resultado) {
            echo "<li>{$resultado->ID} - {$resultado->Buscar} - <a href='admin.php?page=rm&delete={$resultado->ID}' class='button button-secondary'>Eliminar</a></li>";
        }

        echo "</ul>";
    }
    ?>
</div>
<div class="container">

    <?php
    echo "<h1 class='wp-heading-inline title'>" . get_admin_page_title() . "</h1>";
    ?>

    <?php

    global $wpdb;
    $tabla_post = "{$wpdb->prefix}posts";
    $table_rm_plugin = "{$wpdb->prefix}rm_plugin";

    if (isset($_POST['buttonnsave'])) {

        $buscar = $_POST['buscar'];
        $sustituir = $_POST['sustituir'];



        if ($buscar !== $sustituir) {

            $wpdb->query(
                $wpdb->prepare(
                    "UPDATE {$wpdb->prefix}posts
                    SET post_content = REPLACE(post_content, %s, %s)
                    WHERE post_type = 'post'",
                    $buscar,
                    $sustituir
                )
            );

            $wpdb->query(
                $wpdb->prepare(
                    "UPDATE {$wpdb->prefix}posts
                    SET post_title = REPLACE(post_title, %s, %s)
                    WHERE post_type = 'post'",
                    $buscar,
                    $sustituir
                )
            );

            $wpdb->query(
                $wpdb->prepare(
                    "UPDATE {$wpdb->prefix}posts
                    SET post_name = REPLACE(post_name, %s, %s)
                    WHERE post_type = 'post'",
                    $buscar,
                    $sustituir
                )
            );

            $wpdb->query(
                $wpdb->prepare(
                    "INSERT INTO {$table_rm_plugin} (Buscar, Sustituir) VALUES (%s, %s)",
                    $buscar,
                    $sustituir
                )
            );
        }

        echo 'Búsqueda y reemplazo completados.';
    }

    ?>
    <div class="wrap">
        <form class="formm" method="post">
            <label for="buscar">Buscar:</label>
            <input type="text" id="buscar" name="buscar" placeholder="Ingrese la palabra a buscar">

            <label for="sustituir">Sustituir:</label>
            <input type="text" id="sustituir" name="sustituir" placeholder="Ingrese la palabra a sustituir">

            <input type="submit" id="buttonnsave" name="buttonnsave" value="Guardar">
        </form>
    </div>
</div>
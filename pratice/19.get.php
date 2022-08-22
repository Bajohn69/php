<a href="?name=小新&a[]=100&a[]=120&b[name]=bill&b[age]=23">test</a>
<!-- 這邊等於在網址後面打 ?name=小新&a[]=100&a[]=120&b[name]=bill&b[age]=23 -->
<!-- 然後只要是陣列，php 就會幫你排成陣列 -->

<pre>
    <?php
        print_r($_GET);
    ?>
</pre>
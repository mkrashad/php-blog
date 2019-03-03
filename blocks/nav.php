<table>
    <tr>
        <td width="27%"
            <?php if (isset($n)) {
                if ($n == 1)
                    echo "class='nav_a'";
                else 
                    echo "class='nav_t'"; }?>><p><strong><a href="index.php">Главная</a></strong></p></td>
                            <td width="27%"   <?php if (isset($n)) {
                if ($n == 2)
                    echo "class='nav_a'";
                else 
                    echo "class='nav_t'"; }?>><p><strong><a href="subscribe.php">Рассылка</a></strong></p></td>
                            <td width="27%"   <?php if (isset($n)) {
                if ($n == 3)
                    echo "class='nav_a'";
                else 
                    echo "class='nav_t'"; }?>><p><strong><a href="goodies.php">Товары</a></strong></p></td>
                            <td width="110px"   <?php if (isset($n)) {
                if ($n == 4)
                    echo "class='nav_a'";
                else 
                    echo "class='nav_t'"; }?>><p><strong><a href="about.php">О нас</a></strong></p></td>
                        </tr>
                        </table>
<?php
foreach ($changeList as $line){
    echo "<tr>";
    echo "<td>".$line['capitalC']."</td>";
    echo "<td>".$line['tauxC']."</td>";
    echo "<td>".$line['changeC']."</td>";
    echo "<td>".$line['resteC']."</td>";
    echo "<td>".$line['dateComplet']."</td>";
    echo "</tr>";
}
?>
<?php
include ('word.class.php');
$html = <<<HTML
<img src="brasao_cor.png"  align="center"/>


<table width='100%' border='1'>
    <thead>
        <tr style='background-color: #EEE'>
            <th>Nome</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Pedro </td>
            <td>pedro@oi.com.br</td>
        </tr>
        <tr>
            <td>Carla</td>
            <td>carla@oi.com.br</td>
        </tr>
        <tr>
            <td>Julia</td>
            <td>julia@oi.com.br</td>
        </tr>
    </tbody>
</table>
HTML;

new Word($html);

?>
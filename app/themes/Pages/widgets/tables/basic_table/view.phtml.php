<thead><tr>
                    <?php foreach ($parm['db']['series'][0] as $item) { ?>
                    <th><?php echo $item; ?> </th>
                    <?php } ?>
                          </tr></thead>
<tbody>
                          
                             <?php foreach ($parm['db']['series'] as $row) { ?>
                             <tr>
        <?php foreach ($row as $item) { ?>
<td class="v-align-middle"><?php echo $item; ?> </td>
        <?php } ?>
</tr>
<?php } ?>
                        </tbody><?php echo $this->getContent(); ?>
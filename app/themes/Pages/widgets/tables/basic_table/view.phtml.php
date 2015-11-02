<thead><tr>
                    <?php foreach ($parm['db'][0]['series'] as $item) { ?>
                    <th><?php echo $item; ?> </th>
                    <?php } ?>
                          </tr></thead>
<tbody>
                          
                             <?php foreach ($parm['db'] as $row) { ?>
                             <tr>
        <?php foreach ($row['series'] as $item) { ?>
<td class="v-align-middle"><?php echo $item; ?> </td>
        <?php } ?>
</tr>
<?php } ?>
                        </tbody><?php echo $this->getContent(); ?>
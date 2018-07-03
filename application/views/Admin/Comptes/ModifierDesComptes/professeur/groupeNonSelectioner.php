<?php
 foreach ($LesGroupes as $UnGroupe) {
  echo "<tr><td>".$UnGroupe['nom'].'-'.$UnGroupe['annee'].' / '.$UnGroupe['nomenclature']."<input type='checkbox' name='chkGroupe[]' value=".$UnGroupe['num']."></td></tr>";
}?>
</tr>
    </table>
</td>
</tr>
<tr>
<td colspan="5">
<hr>
</td>
</tr>
<tr>
<td align='center' colspan="5">
<input  type="submit" name="envoi" value="Modifier">
</td>
</tr>
</table>
</form>

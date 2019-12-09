<?php
?>

<form action="/entry/doadd" method="post">
  <table cellpadding="2" cellspacing="0" width="50%" align="center">
    <tr>
      <td>Title*:</td>
      <td><input type="text" name="title" value="" maxlength="512"></td>
    </tr>
    <tr>
      <td>Text*:</td>
      <td>
        <textarea name="text" cols="30" rows="10"></textarea>
      </td>
    </tr>
    <tr>
      <td></td>
      <td align="left">
        <button type="submit">Add entry</button>
      </td>
    </tr>

  </table>
</form>
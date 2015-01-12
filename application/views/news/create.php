<h2>建立新聞項目</h2>
<?php echo validation_errors();?>
<?php echo form_open('news/create')?>
<label for="title">標題</label>
<input type = "input" name="title"><br>
<label for="text">內文</label>
<textarea name="text"></textarea><br>
<input type="submit" name="submit" value="建立新聞項目">
</form>
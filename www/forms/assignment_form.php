<form action="newAssignmentscript.php" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br>
        
        <label for="start_date">Start Date:</label><br>
        <input type="datetime-local" id="start_date" name="start_date"><br>
        
        <label for="end_date">End Date:</label><br>
        <input type="datetime-local" id="end_date" name="end_date"><br>
        
        <input type="submit" value="Submit">
</form>
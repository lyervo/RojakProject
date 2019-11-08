<htm>
    <head>
        <title></title>
    </head>
    <body>
        <script>
        
            function submit()
            {
                var xhr = new XMLHttpRequest();
                // Add any event handlers here...
                xhr.onreadystatechange = function()
                    {
                        if (this.readyState == 4 && this.status == 200)
                        {
                            alert(this.responseText);
                        }
                    };
                // The Javascript
                var fileInput = document.getElementById('file');
                var file = fileInput.files[0];
                var formData = new FormData();
                formData.append('file', file,"file name");
                formData.append('name',"Hello world");
                
                
                xhr.open('POST', 'file/fileUpload.php', true);
                xhr.send(formData);
            }
        
        </script>
        
        <input type="file" name="file" id="file" onchange="submit()">
        
        
    </body>
</htm>
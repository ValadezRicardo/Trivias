 function downloadCSV(csv, filename) {
            var csvFile;
            var downloadLink;

            // CSV file
            csvFile = new Blob([csv], {
                type: "text/csv"
            });

            // Download link
            downloadLink = document.createElement("a");

            // File name
            downloadLink.download = filename;

            // Create a link to the file
            downloadLink.href = window.URL.createObjectURL(csvFile);

            // Hide download link
            downloadLink.style.display = "none";

            // Add the link to DOM
            document.body.appendChild(downloadLink);

            // Click download link
            downloadLink.click();
        }

        function exportTableToCSV(filename) {
            var csv = [];
            var rows = document.querySelectorAll(".table-striped tr");

            for (var i = 0; i < rows.length; i++) {
                var row = [],
                 cols = rows[i].querySelectorAll("td:not(.accion), th:not(.accion)");

                for (var j = 0; j < cols.length; j++)
                    row.push(cols[j].innerText);

                csv.push(row.join(","));
            }

            // Download CSV file
            downloadCSV(csv.join("\n"), filename);
        }

        function DeleteandRedirect(url){
            var res=confirm("Desea eliminar"); 
            if(res){
                window.location=url;  
            }
        }

        function appendPregunta(opc){
            switch(opc){
             case "1":{
                $('form fieldset').text('')
                $('form').append('<fieldset style="color: white;"><b>Imagen&nbsp;&nbsp;:</b><br /><div style=" margin: 0; " class="form-group"><input type="file" class="form-control" name="imagen"></div></br><b>Pregunta&nbsp;&nbsp;:</b><br /> <div class="form-group"><label class="col-md-12 control-label" for="qns "> </label><div class="col-md-12"> <textarea rows="3" cols="5" name="oqns" class="form-control" placeholder=""> </textarea> </div></div><b>Opciones&nbsp;&nbsp;:</b><br /><div class="form-group"> <label class="col-md-12 control-label" for="1"></label> <div class="col-md-12"> <input id="1" name="o1" placeholder="Ingrese la opción a" class="form-control input-md" type="text"> </div> </div> <div class="form-group"> <label class="col-md-12 control-label" for="2"></label> <div class="col-md-12"> <input id="2" name="o2" placeholder="Ingrese la opción b " class="form-control input-md" type="text"> </div> </div> <div class="form-group"> <label class="col-md-12 control-label" for="3"></label> <div class="col-md-12"> <input id="3" name="o3" placeholder="Ingrese la opción c" class="form-control input-md" type="text"> </div> </div> <div class="form-group"> <label class="col-md-12 control-label" for="4"></label> <div class="col-md-12"> <input id="4" name="o4" placeholder="Ingrese la opción d" class="form-control input-md" type="text"> </div> </div> <div class="form-group"> <label class="col-md-12 control-label" for="4"></label> <div class="col-md-12"> <input id="5" name="o5" placeholder="Ingrese la opción e" class="form-control input-md" type="text"> </div> </div> <div class="form-group"> <label class="col-md-12 control-label" for="4"></label> <div class="col-md-12"> <input id="6" name="o6" placeholder="Ingrese la opción f" class="form-control input-md" type="text"> </div> </div> <br /> <b>Respuesta correcta</b>:<br /> <select id="ans" name="ans" placeholder="Selecciona la respuesta correcta " class="form-control input-md" ><option value="1"> opcion a</option> <option value="2"> opcion b</option> <option value="3"> opcion c</option> <option value="4"> opcion d</option> <option value="5"> opcion e</option> <option value="6"> opcion f</option> </select><br /><br /><div class="form-group"> <label class="col-md-12 control-label" for=""></label> <div class="col-md-12"> <input  type="submit" style="margin-left: 10px;float: right;" class="btn btn-primary" value="Guardar y Nueva Pregunta" class="btn btn-primary"/> <input  type="submit" style="float: right;" class="btn btn-primary" value="Guardar y Finalizar" class="btn btn-primary"/> </div> </div></fieldset><script>$('+"'"+'[type="submit"]'+"'"+').on("mouseenter",function(){$('+"'"+'[name="dest"]'+"'"+').val($(this).val())})</script>')
             }
                 break;   
             case "2":{
                $('form fieldset').text('')
                $('form').append('<fieldset style="color: white;"><b>Imagen&nbsp;&nbsp;:</b><br /><div style=" margin: 0; " class="form-group"><input type="file" class="form-control" name="imagen"></div></br><b>Pregunta&nbsp;&nbsp;:</><br /><!-- Text input--><div class="form-group"><label class="col-md-12 control-label" for="qns "></label><div class="col-md-12"><textarea rows="3" cols="5" name="oqns" class="form-control" placeholder=""></textarea></div></div> <b>Respuesta correcta</b>:<br /><div class="column-12"><textarea rows="3" cols="5" name="ans" class="form-control"></textarea></div><br/><br /><br /><div class="form-group"> <label class="col-md-12 control-label" for=""></label><div class="col-md-12"><input  type="submit" style="margin-left: 10px;float: right;" class="btn btn-primary" value="Guardar y Nueva Pregunta" class="btn btn-primary"/><input  type="submit" style="float: right;" class="btn btn-primary" value="Guardar y Finalizar" class="btn btn-primary"/></div></div></fieldset><script>$('+"'"+'[type="submit"]'+"'"+').on("mouseenter",function(){$('+"'"+'[name="dest"]'+"'"+').val($(this).val())})</script>')
             }
                    break;
             case "3":
                {
                    $('form fieldset').text('')
                    $('form').append('<fieldset style="color: white;"><b>Imagen&nbsp;&nbsp;:</b><br /><div style=" margin: 0; " class="form-group"><input type="file" class="form-control" name="imagen"></div></br><b>Pregunta&nbsp;&nbsp;:</b><br /> <div class="form-group"><label class="col-md-12 control-label" for="qns "> </label><div class="col-md-12"> <textarea rows="3" cols="5" name="oqns" class="form-control" placeholder=""> </textarea> </div></div><b>Respuesta correcta</b>:<br /><select id="ans" name="ans" placeholder="Selecciona la respuesta correcta " class="form-control input-md" ><option value="Si">Si </option><option value="No"> No</option>> </select><br /><br /><div class="form-group"> <label class="col-md-12 control-label" for=""></label><div class="col-md-12"><input  type="submit" style="margin-left: 10px;float: right;" class="btn btn-primary" value="Guardar y Nueva Pregunta" class="btn btn-primary"/><input  type="submit" style="float: right;" class="btn btn-primary" value="Guardar y Finalizar" class="btn btn-primary"/></div></div></fieldset><script>$('+"'"+'[type="submit"]'+"'"+').on("mouseenter",function(){$('+"'"+'[name="dest"]'+"'"+').val($(this).val())})</script>')
           
                 }
                 break;
                }
                $("input[type='file']").change(function(){
                    var tamaño=this.files[0].size;
                    // if(tamaño>65000){
                    //     alert("El tamaño de la imagen es muy grande");
                    //     $("input[type='file']").val("");
                    // }
                })
                }
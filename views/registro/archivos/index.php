<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="http://localhost/mvc/public/css/main.css">
</head>

<body>

    <form name='myform' enctype="multipart/form-data" action='alta.php' method='post'>

        <div class="menu">
            <h2>Registro</h2>
            <p>Nombre : <br>
                <input type="text" name="nombre" id="nombre" placeholder="nombre apellido"></p>
            <p>Nombre de usuario: <br>
                <input type="text" name="username" id="username" placeholder="nameexample1995"></p>
            <p>edad: <br>
                <input type="number" name="edad" id="edad" value=18></p>
            Sexo: <input type="radio" name="sexo" value="Hombre" checked> Hombre
            <input type="radio" name="sexo" value="Mujer"> Mujer
            <p>Correo electronico: <br>
                <input type="text" name="email" id="email" placeholder="name_10@example.com" value="amozpc@gmail.com">
            </p>
            <p>Direccion: <br>
                <input type="text" name="direccion" id="direccion" placeholder="Francisco I. Madero No. 32"
                    value="Francisco I. Madero No. 32"></p>
            <p>Telefono: <br>
                <input type="text" name="telefono" id="telefono" placeholder="9531154758" value="9531154758"></p>
            <p>Ciudad: <br>
                <input type="text" name="ciudad" id="ciudad" placeholder="Tlaxiaco Oax." value="Tlaxiaco Oax."></p>
            <p>Codigo postal: <br>
                <input type="text" name="cp" id="cp" placeholder="47500" value="47500"></p>

            <p>Fotografia: <br><br>
                <input type="file" id="imagensubida" name="imagensubida">
                <ul class="list1">
                    <li>Tamaño: <ul class="list1">
                            <li>max: 600px * 600px</li>
                            <li>min: 200px * 200px</li>
                        </ul>
                    </li>
                    <li>Peso: 200kb</li>
                </ul>

                <p>Password: <br>
                    <input type="password" name="password" id="password"></p>
                <p>Confirmar Password: <br>
                    <input type="password" name="password2" id="password2"></p>

                <p class="center">
                    <input type="submit" value="Registrar">
                </p>

        </div>
    </form>



    <script>
    function enviar() {


        var patron_texto = /^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]{3,}$/;
        var patron_email = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/;
        var patron_pass = /^[a-zA-Z0-9]{4,8}$/;
        var patron_direc = /^[a-zA-Z0-9#\s\.?]{4,60}$/;

        var patron_tel = /^[0-9]{10,10}$/;
        var patron_num = /^[0-9]$/;
        var patron_cp = /^[0-9]{5,5}$/;




        var formulario = document.getElementById("myform");
        var dato = false;

        if (!(patron_texto.test(document.getElementById("nombre").value))) {
            document.getElementById("nombre").style.backgroundColor = "red";
            alert("Error en Campo \"Nombre\"\r\nIngrese minimo 3 caracteres. Solo se permite letras.");
        } else {
            document.getElementById("nombre").style.backgroundColor = "white";

            if (!(patron_pass.test(document.getElementById("username").value))) {
                document.getElementById("username").style.backgroundColor = "red";
                alert("Error en Campo \"Nombre de Usuario\"\r\nIngrese minimo 4 caracteres. Solo se permite letras.");
            } else {
                document.getElementById("username").style.backgroundColor = "white";

                if (!(/^[0-9]+$/.test(document.getElementById("edad").value))) {
                    document.getElementById("edad").style.backgroundColor = "red";
                    alert("Error en Campo \"Edad\"\r\n Solo se permite numeros.");
                } else {
                    document.getElementById("edad").style.backgroundColor = "white";

                    if ((document.getElementById("edad").value) < 18) {
                        document.getElementById("edad").style.backgroundColor = "red";
                        alert(
                            "Error en Campo \"Edad\"\r\nDebes ser Mayor de edad.");
                    } else {
                        document.getElementById("edad").style.backgroundColor = "white";

                        if (obtenerRadioSeleccionado("myform", "sexo") == false) {
                            alert("Error en Campo \"sexo\"\r\nDebes seleccionar un genero");
                        } else {

                            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(document.getElementById("email")
                                    .value) == false) {
                                document.getElementById("email").style.backgroundColor = "red";
                                alert("Error en Campo \"Correo electronico\"\r\nVerifique que su correo este correcto");
                            } else {
                                document.getElementById("email").style.backgroundColor = "white";


                                if (!(patron_direc.test(document.getElementById("direccion").value))) {
                                    document.getElementById("direccion").style.backgroundColor = "red";
                                    alert(
                                        "Error en Campo \"direccion\"\r\nVerifique su direccion. Mo se permiten caracteres especiales a exepcion de #"
                                    );
                                } else {
                                    document.getElementById("direccion").style.backgroundColor = "white";

                                    if (patron_tel.test(document.getElementById("telefono").value) == false) {
                                        document.getElementById("telefono").style.backgroundColor = "red";
                                        alert("Error en Campo \"Telefono\"\r\nIngrese 10 digitos");
                                    } else {
                                        document.getElementById("telefono").style.backgroundColor = "white";

                                        if (patron_direc.test(document.getElementById("ciudad").value) == false) {
                                            document.getElementById("ciudad").style.backgroundColor = "red";
                                            alert(
                                                "Error en Campo \"ciudad\"\r\nVerifique el nombre. No se permiten caracteres especiales"
                                            );
                                        } else {
                                            document.getElementById("ciudad").style.backgroundColor = "white";

                                            if (patron_cp.test(document.getElementById("cp").value) == false) {
                                                document.getElementById("cp").style.backgroundColor = "red";
                                                alert(
                                                    "Error en Campo \"Codigo postal\"\r\nIngrese 5 caracteres numericos. No se permiten caracteres especiales "
                                                );
                                            } else {
                                                document.getElementById("cp").style.backgroundColor = "white";


                                                if (document.getElementById("imagensubida").files.length == 0) {
                                                    alert(
                                                        "Error en Campo \"Fotografia \"\r\nSeleccione una imagen "
                                                    );
                                                } else {

                                                    if (validarImagen(document.getElementById("imagensubida")) ==
                                                        false) {
                                                        document.getElementById("imagensubida").style.backgroundColor =
                                                            "red";

                                                    } else {
                                                        document.getElementById("imagensubida").style.backgroundColor =
                                                            "white";

                                                        if (!(patron_pass.test(document.getElementById("password")
                                                                .value))) {
                                                            document.getElementById("password").style.backgroundColor =
                                                                "red";
                                                            alert(
                                                                "Error en Campo \"Password \"\r\nIngrese min 4 y max 8 caracteres. No se permiten caracteres especiales "
                                                            );

                                                        } else {
                                                            document.getElementById("password").style.backgroundColor =
                                                                "white";

                                                            if (!(patron_pass.test(document.getElementById("password2")
                                                                    .value))) {
                                                                document.getElementById("password2").style
                                                                    .backgroundColor =
                                                                    "red";
                                                                alert(
                                                                    "Error en Campo \"Password \"\r\nIngrese min 4 y max 8 caracteres. No se permiten caracteres especiales "
                                                                );

                                                            } else {
                                                                document.getElementById("password2").style
                                                                    .backgroundColor =
                                                                    "white";

                                                                if ((document.getElementById("password2").value) != (
                                                                        document.getElementById("password2").value)) {
                                                                    document.getElementById("password2").style
                                                                        .backgroundColor =
                                                                        "red";
                                                                    alert(
                                                                        "Error en Campo \"Password \"\r\nLa contraseña no coincide "
                                                                    );

                                                                } else {
                                                                    document.getElementById("password2").style
                                                                        .backgroundColor =
                                                                        "white";
                                                                    dato = true;



                                                                }


                                                            }


                                                        }


                                                    }
                                                }


                                            }


                                        }


                                    }


                                }

                            }


                        }


                    }

                }

            }
        }


        if (dato == true) {
            alert("Enviando el formulario");
            myform.submit();
            return true;
        } else {
            alert("No se envía el formulario");
            return false;
        }

        function validatename(names) {
            if (!(/^[a-zA-Z]{4,}$/.test(names))) {
                alert("Error en Campo \"Nombre\"\r\nIngrese minimo 4 caracteres. Solo se permite letras.");

                return false;
            }
        };



    }

    function validarImagen(obj) {
        var uploadFile = obj.files[0];

        if (!window.FileReader) {
            alert("Error en Campo \"Fotografia\"\r\nEl navegador no soporta la lectura de archivos");
            return false;
        }

        if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
            alert("Error en Campo \"Fotografia\"\r\nEl archivo a adjuntar no es una imagen");
        } else {
            var img = new Image();
            img.onload = function() {
                if ((this.width.toFixed(0) >= 600 && this.height.toFixed(0) >= 600) || (this.width.toFixed(0) <=
                        600 && this.height.toFixed(0) <= 200)) {
                    alert("Error en Campo \"Fotografia\"\r\nLas medidas deben ser: 200px * 200px");
                    return false;
                } else if (uploadFile.size > 200000) {
                    alert("Error en Campo \"Fotografia\"\r\nEl peso de la imagen no puede exceder los 200kb")
                    return false;
                } else {
                    // alert('Imagen correcta :)')
                    return true;

                    // img.src = URL.createObjectURL(uploadFile);
                }
            };



        }
    }

    function obtenerRadioSeleccionado(formulario, nombre) {
        elementos = document.getElementById(formulario).elements;
        longitud = document.getElementById(formulario).length;
        for (var i = 0; i < longitud; i++) {
            if (elementos[i].name == nombre && elementos[i].type == "radio" && elementos[i]
                .checked == true) {
                return elementos[i];
            }
        }
        return false;
    }
    </script>
</body>

</html>
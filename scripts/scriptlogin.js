                init:function clear()
                {
                        user.value = "";
                        pass.value = "";
                        document.getElementById("message").innerHTML = "";
                        user.className = "";
                        pass.className = "";
                }

                function validateUser(user){
                        var expr=/^([a-z0-9]{5,10})$/;
                        var errorMessage = 'Usuario Incorrecto.';
                        if (expr.test(user.value)) {
                                user.className = "";
                                document.getElementById("message").innerHTML = "";
                        } else {
                                user.className="invalido";
                                user.value="";
                                document.getElementById("message").innerHTML = errorMessage;

                        }
                }
                function validatePass(pass){
                        var expr=/^([a-z0-9]{5,10})$/;
                        var errorMessage = 'Password Incorrecta.';
                        if ((expr.test(pass.value)) && (pass.value!='')) {
                                pass.className = "";
                                document.getElementById("message").innerHTML = "";
                        } else {
                                pass.className="invalido";
                                pass.value="";
                                document.getElementById("message").innerHTML = errorMessage;
                                /*message.value=errorMessage;
                                var text = document.getElementById("message").InnerTect*/
                        }
                }

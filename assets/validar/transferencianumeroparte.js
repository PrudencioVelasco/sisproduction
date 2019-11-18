$(document).ready(function() {
    $('#registrationForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            numeroparte: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'El numero de parte es requerido.'
                    }
                     
                }
            },
            cliente: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione el Cliente.'
                    }
                }
            },
            modelo: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione el Modelo.'
                    }
                }
            },
             revision: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione el Revision.'
                    }
                }
            },
            linea: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione la Linea.'
                    }
                }
            },
            cajas: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione Cajas.'
                    }
                }
            },
            cantidad: {
                validators: {
                    notEmpty: {
                        message: 'Escriba la cantidad.'
                    },
                    integer: {
                        message: 'Solo permite número.'
                    }
                }
            }
        }
    });
});
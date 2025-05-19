import 'toastr/build/toastr.min.css';
import './bootstrap';

toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "timeOut": "5000",  // Duración de la notificación
    "extendedTimeOut": "1000",
    "positionClass": "toast-top-right", // Posición en la pantalla
    "showMethod": "fadeIn", // Cómo aparece
    "hideMethod": "fadeOut", // Cómo desaparece
    "backgroundColor": "#FF5733", // Color de fondo, puedes cambiarlo
    "iconClass": "toast-info", // Icono de la notificación
};

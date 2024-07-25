try {
    
    
    
    $(document).ready(function () {
        const intro = introJs();
        initializeTour();

    });
    
    
    function logOut(){
        messageAsk("Cerrar Sesión","¿Desea finalizar la sesión?","question",goHome);
    }
    
    function goHome(){
        window.location.assign("/");
    }
    
    function message(title,message,type){
          Swal.fire({
              title: title,
              text: message,
              type: type,
              icon: type,
              font:"Arial"
          });   
        }; 
    
    function messageAsk(title,message,type,callbackFunc){
        Swal.fire({
            title: title,
            text: message,
            icon: type,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OK'
            }).then((result) => {
            if (result.isConfirmed) {
              callbackFunc();
            }
          })
    }    
        
//    function initializeTour(){
//        
//        intro.setOptions({
//            showProgress: true,
//            prevLabel: "Ant",
//            nextLabel: "Sig",
//            doneLabel: "Salir",
//            skipLabel: "Salir",
//            showBullets: false,
//            steps: [
//
//                {
//                    element: document.querySelector('#inicioAyuda'),
//                    intro: '¿Necesita ayuda para agregar un evento?',
//                    position: 'left'
//                }
//               
//                
//                
//            ]
//
//        });
//        
//        
//    }
//    
    
    
} catch (Exception) {
    console.log("Error general de sistema");
}
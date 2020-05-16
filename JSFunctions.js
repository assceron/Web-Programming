//
// $('#signupid').submit(function(ev) {
//   ev.preventDefault(); // to stop the form from submitting
//   /* Validations go here */
//
//   if(form.email.value == "") {
//     alert("Error: email cannot be blank!");
//     form.email.focus();
//   }
//
//   else if(form.pwd.value != "") { //pwd not blanck
//     if(form.pwd.value.length < 3) {
//       alert("Error: Password must contain at least three characters!");
//       form.pwd.focus();
//     }
//
//     re =/[^A-Za-z0-9]+/;
//     if(!re.test(form.pwd.value)) {
//       alert("Error: password must contain at least NOT a letter!");
//       form.pwd.focus();
//
//     }
//
//   }
//   else { ///anche la password è bianca
//     alert("Error: Password blank!");
//     form.pwd.focus();
//     return false;
//   }
//   this.submit(); // If all the validations succeeded
// });

function checkForm(form)
{
  if(form.email.value == "") {
    alert("Error: email cannot be blank!");
    form.email.focus();
    return false;
  }
  else {
    if(form.pwd.value != "") {
      if(form.pwd.value.length < 3) {
        alert("Error: Password must contain at least three characters!");
        form.pwd.focus();
        return false;
      }

      re =/[^A-Za-z0-9]+/;
      if (!re.test(form.pwd.value)) {
        alert("Error: password must contain at least NOT a letter!");
        form.pwd.focus();
        return false;
      }
      // else
      //  return true;
    } else {
      alert("Error: Password blank!");
      form.pwd.focus();
      return false;
    }

  }


  //alert("You entered a valid password: " + form.pwd.value);
  // return true;
}


cellaInizio=false;
cellaFine=false;
flag=0;
function selectCell(cella,MAXLENGHT) {

  if (cellaInizio==false) {
    if (cella.getAttribute("class")=="marked" || cella.getAttribute("class")=="owned" ) {
      alert("Prima mossa non consentita");
    }
    else {
      cellaInizio=cella;
      cella.setAttribute("class","selected");
    }
  }

  else {

    var ri=cellaInizio.id.split("_")[0];
    var ci=cellaInizio.id.split("_")[1];
    var rf=cella.id.split("_")[0];
    var cf=cella.id.split("_")[1];
    //document.getElementById(ri+"_"+ci).setAttribute("class","marked");
    console.log(ri+ci+rf+cf);

    /*RETTAGOLI ORIZZONTALI*/
    if(ri==rf && flag==0){
      console.log("Ciao");
      if(Math.abs(ci-cf)==MAXLENGHT-1){
        if(ci>cf){
          var tmp = ci;
          ci=cf;
          cf=tmp;
        }
        /*COLONNE DIVERSE*/
        var mossaNonConsentita=0;
        for(i=ci;i<=cf;i++){
          var stat = document.getElementById(ri+"_"+i).getAttribute("class");

          if (stat=="marked" || stat=="owned"){
            console.log("OOOOOOO"+stat);
            mossaNonConsentita=1;
          }
          console.log(mossaNonConsentita);
        }
        if(mossaNonConsentita==0){

          for(i=ci;i<=cf;i++){
            document.getElementById(ri+"_"+i).setAttribute("class","selected");
            cellaFine=cella;
            flag=1;
          }
        } else {
          alert("JS: Mossa non consentita");
          reset();
        }
      }
    }

    /*RETTANGOLI VERTICALI*/
    if(ci==cf && flag==0){
      console.log("Ciao");
      if(Math.abs(ri-rf)==MAXLENGHT-1){
        if(ri>rf){
          var tmp = ri;
          ri=rf;
          rf=tmp;
        }

        /*RIGHE DIVERSE*/

        var mossaNonConsentita=0;
        for(i=ri;i<=rf;i++){
          var stat = document.getElementById(i+"_"+ci).getAttribute("class");

          if (stat=="marked" || stat=="owned"){
            console.log("OOOOOOO"+stat);
            mossaNonConsentita=1;
          }
          console.log(mossaNonConsentita);
        }
        if (mossaNonConsentita==0) {
          for(i=ri;i<=rf;i++){
            document.getElementById(i+"_"+ci).setAttribute("class","selected");
            cellaFine=cella;
            flag=1;
          }

        }
        else {
          console.log("Cavall rall a bere");
          alert("JS: Mossa non consentita");
          reset();
        }
      }
    }


  }

  // x[i].setAttribute("class","selected");
}

function reset()
{
  console.log(cellaInizio);
  console.log(cellaFine);
  if(cellaInizio!=false){
    if(cellaFine!=false){ //ho selezionato il rettangolo
      var ri=cellaInizio.id.split("_")[0];
      var ci=cellaInizio.id.split("_")[1];
      var rf=cellaFine.id.split("_")[0];
      var cf=cellaFine.id.split("_")[1];



      if(ri==rf){ //da sx a dx

        if(ci>cf){
          var tmp = ci;
          ci=cf;
          cf=tmp;
        }
        for(i=ci;i<=cf;i++)
        document.getElementById(ri+"_"+i).setAttribute("class","free");
      }

      else { //da sopra a sotto

        if(ri>rf){
          var tmp = ri;
          ri=rf;
          rf=tmp;
        }
        for(i=ri;i<=rf;i++)
        document.getElementById(i+"_"+ci).setAttribute("class","free");
      }
    }
    else { //uno solo selezionato
      var ri=cellaInizio.id.split("_")[0];
      var ci=cellaInizio.id.split("_")[1];
      document.getElementById(ri+"_"+ci).setAttribute("class","free");
    }
  }
  cellaInizio=false;
  cellaFine=false;
  flag=0;

}






//
// <form ... onsubmit="return checkForm(this);">
// <p>email: <input type="text" name="email"></p>
// <p>Password: <input type="password" name="pwd"></p>
// <p>Confirm Password: <input type="password" name="pwd2"></p>
// <p><input type="submit"></p>
// </form>



/*AJAX*/
var req;

function ajaxRequest() {
  try { // Non IE Browser?
    var request = new XMLHttpRequest()
  } catch(e1){ // No
    try { // IE 6+?
      request = new ActiveXObject("Msxml2.XMLHTTP")
    } catch(e2){ // No
      try { // IE 5?
        request = new ActiveXObject("Microsoft.XMLHTTP")
      } catch(e3){ // No AJAX Support
        request = false
      }
    }
  }
  return request
}

// Handler definition
// function f(){
//   if (req.readyState==4 && (req.status== 0 || req.status==200)) {
//       document.getElementsByClassName("selected").innerHTML=req.responseText;
//     }
//   }

// function startAjax() {
//   req = ajaxRequest();
//   req.onreadystatechange = function f(){
//     if (req.readyState==4 && (req.status== 0 || req.status==200)) {
//       document.getElementsByClassName("selected").innerHTML=req.responseText;
//     }
//   };
//   req.open("GET","sendGrey.inc.php", true);
//   req.send();
// }



// $(document).ready( function() {
//
//
//   $('#sendReq').click(function(){
//
//     $(".selected").hide();
//
//
//   });
//
//
//
//
// });

//
function MyAjax(){
  console.log(cellaInizio);
  console.log(cellaFine);
  if(cellaInizio!=false && cellaFine!=false){

    var $ri=cellaInizio.id.split("_")[0];
    var $ci=cellaInizio.id.split("_")[1];
    var $rf=cellaFine.id.split("_")[0];
    var $cf=cellaFine.id.split("_")[1];

    if($ri==$rf){ //da sx a dx

      if($ci>$cf){
        var tmp = $ci;
        $ci=$cf;
        $cf=tmp;
      }

    }

    else { //da sopra a sotto

      if($ri>$rf){
        var tmp = $ri;
        $ri=$rf;
        $rf=tmp;
      }

    }

    // var varData = ri + ci + rf + cf;
    // console.log(data);
    var dataVar = {
      rigai:$ri,
      colonnai:$ci,
      rigaf:$rf,
      colonnaf:$cf
    };
    var dataRet;
    $.ajax({
      type: "POST",
      url: 'sendGrey.inc.php',
      data: dataVar,
      success: function(dataRet){
        alert("AjaxSuccess "+ dataRet)
        document.location.reload(true);
        console.log('Success ajax: ' + dataRet +";");
        //alert("success"+data);
      },
      error: function(){
        alert("AjaxError "+ dataRet)
        document.location.reload(true);
        console.log('error ajax: ' + dataRet);
      }
    });
  }
  console.log("green "+ dataRet);

  console.log("CellaInizio="+cellaInizio);
  console.log("CellaInizio="+cellaFine);
  resetGlob();

  //sleep(1);
  // document.location.reload();
  // location.reload();

  //  reset();
  // location.reload();

}

function paintGreen(){
  {
    console.log(cellaInizio);
    console.log(cellaFine);
    if(cellaInizio!=false){
      if(cellaFine!=false){ //ho selezionato il rettangolo
        var ri=cellaInizio.id.split("_")[0];
        var ci=cellaInizio.id.split("_")[1];
        var rf=cellaFine.id.split("_")[0];
        var cf=cellaFine.id.split("_")[1];



        if(ri==rf){ //da sx a dx

          if(ci>cf){
            var tmp = ci;
            ci=cf;
            cf=tmp;
          }
          for(i=ci;i<=cf;i++)
          document.getElementById(ri+"_"+i).setAttribute("class","owned");
        }

        else { //da sopra a sotto

          if(ri>rf){
            var tmp = ri;
            ri=rf;
            rf=tmp;
          }
          for(i=ri;i<=rf;i++)
          document.getElementById(i+"_"+ci).setAttribute("class","owned");
        }
      }
      else { //uno solo selezionato
        var ri=cellaInizio.id.split("_")[0];
        var ci=cellaInizio.id.split("_")[1];
        document.getElementById(ri+"_"+ci).setAttribute("class","owned");
      }
    }
    cellaInizio=false;
    cellaFine=false;
    flag=0;

  }

}

function resetGlob(){
  cellaInizio=false;
  cellaFine=false;
  flag=0;
}

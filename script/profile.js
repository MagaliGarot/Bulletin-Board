
//Formatage de texte dans le créateur de texte
const simplemde = new SimpleMDE({ element: document.getElementById("userSignature") });

//Compteur de lettre pour le pseudo
const input = document.getElementById("username");
  const counter = document.getElementById("counter");
  document.getElementById("username").addEventListener("keyup", () => {						
    counter.innerText = `${input.value.length}/16`;
  });

  //confirm password
  document.getElementById("pwd-confirm").addEventListener("keyup",() => {
    const passwordOne = document.getElementById("pwd").value;
    const passwordTwo = document.getElementById("pwd-confirm").value;
    [... document.getElementsByClassName("password-input")].forEach(
      elt =>
        elt.style.borderColor =
          passwordOne !== passwordTwo ? "red" : "silver"
    );
  });

// Pour faire fonctionner les tooltips
  $(function () {
    $('.tooltip-profile').popover({
      container: 'body'
    })
  })

  // Pour le filename dans l'upload de photo de profile 
  $("input[type='file']").click(function () {
    $("input[id='file']").click();
});

$("input[id='file']").change(function (e) {
    var $this = $(this);
    $this.next().html($this.val().split('\\').pop());
});


// Limit the number of character in the input
var etc = '[...]'; // this will be the etcetera text abcd...jkl.doc

// return the basename of a fullpath either window or linux style path

function basename(path) {
  return path.replace(/\\/g, '/').split('/').pop();
}


// get the extension of a path or filename
 
function getExtension(filename) {
    return filename.split('.').pop();
}
function extractLabel(filename, maxlength) {
    var ret = filename;
    
    if (filename.length - etc.length > maxlength){
        var extension = '.' + getExtension(filename);
        var uncuttable = extension.length + etc.length;
        
        ret = filename.substring(0, maxlength - uncuttable) + etc + extension;
    }
    return ret;    
}

function doTheMagic(maxLength) {
  var fake = document.getElementById('labelfile');
  var real = document.getElementById('file');
  var file = basename(real.value);
        
  fake.innerHTML = extractLabel(file, maxLength);
}
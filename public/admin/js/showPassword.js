function myFunction() {
  var x = document.getElementById("myInputx");
    
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
    
}

function myFunction2() {
  var y = document.getElementById("myInputy");
  var z = document.getElementById("myInputz");

  if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
    
  if (z.type === "password") {
    z.type = "text";
  } else {
    z.type = "password";
  }
    
}
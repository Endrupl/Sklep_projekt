document.addEventListener("click", function(event)
{
	if(event.target.value.substring(0, 4) == "prod")
	{
		var formularz = document.getElementById(event.target.value);
		formularz.style.visibility = "visible";
	}
});
<h1>BRAVO !</h1>
<input type="button" onclick="decrementValue()" value="-" />
<select id="ddlEmployee" class="form-control">
    <option value="">-- Select --</option>
    <option value="1" data-city="Washington" data-doj="20-06-2011">John</option>
    <option value="2" data-city="California" data-doj="10-05-2015">Clif</option>
    <option value="3" data-city="Delhi" data-doj="01-01-2008">Alexander</option>
</select>
<input type="button" onclick="incrementValue()" value="+" />








<script type="text/javascript">
    function incrementValue()
    {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        if(value<10){
            value++;
            document.getElementById('number').value = value;
        }
    }
    function decrementValue()
    {
        var value = parseInt(document.getElementById('number').value, 10);
        value = isNaN(value) ? 0 : value;
        if(value>1){
            value--;
            document.getElementById('number').value = value;
        }

    }
</script>
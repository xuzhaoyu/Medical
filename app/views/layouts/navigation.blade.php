<style>
ul{
    list-style-type: none;
    padding:0;
    margin:0;
    font-size:27px;
  }
li{
    float:left;
    padding-right: 32px;
}
</style>
<br>
<br>
<nav>
    <ul>
         <li><a href="{{ URL::route('home') }}">Home</a></li>
         <li><a href="{{ URL::route('addNum') }}">加电话</a></li>
         <li><a href="{{ URL::route('delNum') }}">删电话</a></li>
    </ul>
</nav>
<br>
<br>
<br>
<br>

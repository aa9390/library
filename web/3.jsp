<%@ page contentType="text/html;charset=UTF-8" %>
<META HTTP-EQUIV="contentType" CONTENT="text/html;charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<html lang="ko">
    
<head>
    <meta charset="euc-kr">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="An interactive getting started guide for Brackets.">
    <title>우리집 앞 도서관</title>
    
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="main.css">
    
<style>
    #table{
        position:absolute;
        top:17%;
        margin-left: 5%;
        width: 90%;
        height: 50%;
    }
    
    .vertical {
        display: table-cell;
        vertical-align: middle;
    }
    
    
#map-canvas, #map_canvas { 
  width : 300px; /* 구글 지도 넓이 */ 
  height: 300px; /* 구글 지도 높이 */ 
  font-size:12px; 
} 
</style>    
</head>
    
<body>
            <!-- 네비게이션 바 -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    
                    <span class="sr-only">Toggle navigation</span>     
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                
                </button>
                
                <a class="navbar-brand" href="index.html">우리집 앞 도서관</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="6.html">도서찾기<span class="sr-only">(current)</span></a></li>
                    <li><a href="2.html">도서관찾기</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">독자의견 <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li class="active"><a href="12.html">서평</a></li>
                            <li><a href="16.html">한줄의견</a></li>
                        </ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="index.html">HOME</a></li>
                    <li><a href="17.html">JOIN</a></li>
                    <li><a href="18.html">LOGIN/OUT</a></li>
                    <li><a href="#">MYPAGE</a></li>
                </ul>    
            </div>
        </div>
    </nav>
    
    <!-- 드롭다운 도-->
    <div class="btn-group" style="margin:20 0 0 100">
        <a href="#" class="btn btn-default"> 서울시 </a>
        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><span class="caret" style="margin:8 0"></span></a>
        <ul class="dropdown-menu">
            <li><a href="#">서울특별시</a></li>
            <li><a href="#">경기도</a></li>
            <li><a href="#">강원도</a></li>
        </ul>
    </div>
    
        <div class="btn-group" style="margin:20 0 0 20">
        <a href="#" class="btn btn-default"> 광진구 </a>
        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><span class="caret" style="margin:8 0"></span></a>
        <ul class="dropdown-menu">
            <li><a href="#">광진구</a></li>
            <li><a href="#">송파구</a></li>
            <li><a href="#">성북구</a></li>
        </ul>
    </div>
    
        <div class="btn-group" style="margin:20 0 0 20">
        <a href="#" class="btn btn-default"> 구의3동 </a>
        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><span class="caret" style="margin:8 0"></span></a>
        <ul class="dropdown-menu">
            <li><a href="#">구의동</a></li>
            <li><a href="#">화양동</a></li>
            <li><a href="#">광장동</a></li>
        </ul>
    </div>
    
    <!-- 검색 바 -->
    <div class="form-group" style="margin: -34 300 0 450">
        <div class="input-group">
    <div class="row">        
    <div class="col-lg-6">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="광진도서관">
      <span class="input-group-btn">
        <button class="btn btn-secondary" type="button">검색</button>
      </span>
    </div>
  </div>
    </div>   
    </div>
    </div>
            <!-- 수평 구분선 -->
    <hr />
        <div> </div>
    <hr />
    
    <!-- 도서관 검색 지도-->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=en"></script> 
<script> 
function initialize() { 
    
  var Y_point        = <%=request.getParameter("Y_point")%>;
  var X_point        = <%=request.getParameter("X_point")%>; 
    
  var zoomLevel      = 17;  // 첫 로딩시 보일 지도의 확대 레벨 
  var markerTitle    = "도서관 이름";  // 현재 위치 마커에 마우스를 올렸을때 나타나는 이름 
  var markerMaxWidth = 350;  // 마커를 클릭했을때 나타나는 말풍선의 최대 크기 

  var myLatlng = new google.maps.LatLng(Y_point, X_point); 
  var mapOptions = { 
    zoom: zoomLevel, 
    center: myLatlng, 
    mapTypeId: google.maps.MapTypeId.ROADMAP 
  } 
  
  var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions); 

  var marker = new google.maps.Marker({ 
    position: myLatlng, 
    map: map, 
    draggable:true, 
    animation: google.maps.Animation.DROP, 
    title: markerTitle 
  }); 

  var infowindow = new google.maps.InfoWindow({ 
    content: contentString, 
    maxWidth: markerMaxWidth 
  }); 
  infowindow.open(map, marker); 

  google.maps.event.addListener(marker, 'click', function() { 
    infowindow.open(map, marker); 
  }); 
} 
    
var x = document.getElementById("demo");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}
function showPosition(position) {
    x.innerHTML = "Latitude: " + position.coords.latitude + 
    "<br>Longitude: " + position.coords.longitude; 
}
google.maps.event.addDomListener(window, 'load', initialize); 
</script><div id="map_canvas" style="float:left; border:1px solid #ccc; margin:0 0 0px 0;"></div>
    
            <!-- 도서관 검색 결과 표-->
    <div class="vertical" style="margin-top:20" "float: right;">
        <table class="table table" id="tblae" >
           <tbody>
            <tr>
                <td> 광진구 구립 도서관  </td>
                <td> 4.5km </td>
                <td> <button type="button" class="btn btn-info">길찾기</button> </td>
            </tr>            
            <tr>
                <td> 새빛 작은 도서관 </td>
                <td> 6.5km </td>
                <td> <button type="button" class="btn btn-info">길찾기</button> </td>
            </tr>            
            <tr>
                <td> 구의 제3동 도서관 </td>
                <td> 14.5km </td>
                <td> <button type="button" class="btn btn-info">길찾기</button> </td>
            </tr>            
            <tr>
                <td> 화양동문고 </td>
                <td> 20km </td> 
                <td> <button type="button" class="btn btn-info">길찾기</button> </td>
            </tr>            
            </tbody>
        </table>
    </div>               
                    
</body>
</html>
<? 
	session_start(); 
	
	include "../lib/dbconn.php"; 
	
	if ($mode=="level_up")
	{
		$sql = "update member set level = level+1 where id='$id'";
		$result = mysql_query($sql, $connect);
	}
	else if($mode=="level_down")
	{
		$sql = "update member set level = level-1 where id='$id'";
		$result = mysql_query($sql, $connect);
	}
	
	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta charset="euc-kr">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/memo.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
<div id="wrap">
  <div id="header">
    <? include "../lib/top_login2.php"; ?>
  </div>  <!-- end of header -->

  <div id="menu">
	<? include "../lib/top_menu2.php"; ?>
  </div>  <!-- end of menu --> 

  <div id="content">    
	<div id="col1">
		<div id="left_menu">
<?
			include "../lib/left_menu.php";
?>
		</div>
	</div>
	<!-- 모든 회원 정보 검색, 이름으로 검색 - 검색하면 목록이 뜨고, 상세보기를 누르면 그 사람이 가입할 때 적었던 정보가 나옴 -->
	<!-- 상세보기 옆 작성한 글 나옴 - 계정 삭제 누르면 삭제됨 -->
	
	<div id="col2">  
		<div id="title">
			<img src="../img/mem_manage.gif">
		</div><br>
		
			<form method="post" action="member_manage_true.php?&mode=search"> 
			<div align="right" id="list_search">
				<img src="../img/select_search.gif">
					<select name="find">
						<option value='id'>아이디</option>
						<option value='name'>이름</option>
						<option value='nick'>닉네임</option>
					</select>
				<input type="text" name="search">
				<input type="image" src="../img/list_search_button.gif">
			</div>
		</form>

			<p><a href ="member_manage_true.php?mode=member_all">[전체회원]</a> 
			   <a href ="member_manage_true.php?mode=id_first">[아이디순 정렬]</a>
			   <a href ="member_manage_true.php?mode=hp_first">[전화번호순 정렬]</a>
			   <a href ="member_manage_true.php?mode=regist_day_first">[가입날짜순 정렬]</a></p>
		<br>
		<div>
		<form method="get" action="member_update.php?id=$id">
		<table width="830" border="0" cellpadding="7">
			 <tr align="center" bgcolor="#eeeeee">
			 <td>아이디</td>
			 <td>비밀번호</td>
			 <td>이름</td>
			 <td>닉네임</td>
			 <td>레벨</td>
			 <td>전화번호</td>
			 <td>이메일</td>
			 <td>가입날짜</td>
			 <td>작성한댓글</td>
			 <td colspan="2">&nbsp;</td>			 
			 </tr>
			 

		
<?
	if ($mode == "mem_all")          
       $sql = "select * from member";
	else if ($mode == "id_first")          
       $sql = "select * from member order by id";
    else if ($mode == "regist_day_first")   
       $sql = "select * from member order by regist_day";
    else if ($mode == "hp_first")   
    $sql = "select * from member order by hp";
	else if ($mode=="search")
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
			exit;
		}

		$sql = "select * from member where $find like '%$search%' order by id desc";
	}
    else 
       
   $sql = "select * from member order by id";
   
	$result = mysql_query($sql);
	   
	$fields = mysql_num_fields($result);
	$records = mysql_num_rows($result);
	
    $count = 0;  
	
	 while ($row = mysql_fetch_array($result))
    {   
	$num = $row[num];
       echo "<tr align='center'>
             <td> <u><a href='../img/man.jpg' onclick='window.open('../img/man.jpg', '', 'width=150px,height=150px,toolbars=no,scrollbars=no'); return false;'>$row[id]</a></u> </td>
			 <td> $row[pass] </td>
             <td> $row[name] </td>
             <td> $row[nick] </td>
			 <td> $row[level] <a href ='member_manage_true.php?mode=level_up&id=$row[id]'>▲</a>
			 <a href ='member_manage_true.php?mode=level_down&id=$row[id]'>▼</a></td>
             <td> $row[hp] </td>
             <td> <u><a href='mailto:$row[email]'>$row[email]</a></u></td>
             <td> $row[regist_day]  </td>
             <td> 
		 <a href='member_manage_true.php?id=$row[id]'>[낙서장]</a></td>
		 <td><a href='member_manage_true.php?mode=update&id=$row[id]'>[수정]</a></td>
		 <td><a href='member_delete.php?id=$row[id]'>[삭제]</a></td>
         </tr>
             ";
     
       $count++;
     }
	 

 // DB 데이터 출력 끝
                // DB 접속 끊기
 ?>

 
 </table>
 </form><br>
 <div>▷ 총 <?=$count?> 명의 회원이 있습니다.  </div>
 </div>
 <br>

 <hr>
 <p><a href ="member_manage_true.php?mode=rip_all">[전체댓글]</a><p> <!--mode는 모두 get방식-->

		
<?
	if($mode=="update")
	{
		$sql = "select * from member where id='$id'";
		$result = mysql_query($sql);
		
		echo 
		"
		<table width='830' border='0' cellpadding='7'>
			 <tr align='center' bgcolor='#eeeeee'>
			 <td>아이디</td>
			 <td>비밀번호</td>
			 <td>이름</td>
			 <td>닉네임</td>
			 <td>레벨</td>
			 <td>전화번호</td>
			 <td>이메일</td>
			 <td>가입날짜</td>		 
			 <td>적용</td>
			 </tr>";
			 
	   
	$fields = mysql_num_fields($result);
	$records = mysql_num_rows($result);

	 while ($row = mysql_fetch_array($result))
    {   
       echo "<tr align='center'>
			 <form method='get' action='./member_update.php?id=$id'>
             <td> <input type='text' name='id' value='$row[id]' readonly size='6'></td>
             <td> <input type='text' name='pass' value='$row[pass]' size='5' ></td>
             <td> <input type='text' name='name' value='$row[name]' size='5'></td>
             <td> <input type='text' name='nick' value='$row[nick]' size='5'></td>
			 <td> <input type='text' name='level' value='$row[level]' size='3'></td>
             <td> <input type='text' name='hp' value='$row[hp]' size='5' ></td>
             <td> <input type='text' name='email' value='$row[email]' size='7' ></td>
             <td> <input type='text' name='regist_day' value='$row[regist_day]' size='7'></td>
			 <td> <input type='submit' value='√'></a></td>
         </tr></table></form>
             ";

     }
	}
	 
	else
	{
		echo 
		" 		
		<table width='830' border='0' cellpadding='7' scrolling='yes'>
			 <tr align='center' bgcolor='#eeeeee'>
			 <td>아이디</td>
			 <td>이름</td>
			 <td>닉네임</td>
			 <td width='45%'>내용</td>
			 <td>작성날짜</td>
			 <td>댓글삭제</td>
			 <td>계정삭제</td>			 
			 </tr>";
	
	if ($mode=="rip_all")
	$sql = "select * from memo_ripple";
	else 
	$sql = "select * from memo_ripple where id='$id'";

	$result = mysql_query($sql);
	
	//$fields = mysql_num_fields($result);
	//$records = mysql_num_rows($result);
	
    $count = 0;  
	while ($row = mysql_fetch_array($result))
    {   
	$num = $row[num];

       echo "<tr align='center'>
             <td> $row[id] </td>
             <td> $row[name] </td>
             <td> $row[nick] </td>
             <td> <a href ='$row[content]'>$row[content]</a> </td>
             <td> $row[regist_day] </td>
		 <td><a href='../memo/delete_ripple_member.php?num=$num'>[X]</a></td>
		 <td><a href='member_delete.php?id=$id'>[X]</a></td>
         </tr>
             ";
     
       $count++;
		
	}	 
	}		
	
 // DB 데이터 출력 끝

 // DB 접속 끊기
 ?>
 </table><br>
 
 <div>▷ 총 <?=$count?> 개의 댓글이 있습니다.  </div>
		</div>
	</div>
</body>
</html>
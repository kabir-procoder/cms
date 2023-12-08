<?php
include('includes/db.php');
//print_r($_POST);
if(isset($_POST['type']) && $_POST['type']!='' && isset($_POST['post_id']) && $_POST['post_id']>0){
	$type=mysqli_real_escape_string($connection,$_POST['type']);
	$id=mysqli_real_escape_string($connection,$_POST['post_id']);
	
	if($type=='like'){
		if(isset($_COOKIE['like_'.$id])){
			setcookie('like_'.$id,"yes",1);
			$sql="update posts set like_count=like_count-1 where post_id='$id'";
			$opertion="unlike";
		}else{
			
			if(isset($_COOKIE['dislike_'.$id])){
				setcookie('dislike_'.$id,"yes",1);
				mysqli_query($connection,"update posts set dislike_count=dislike_count-1 where post_id='$id'");
			}
			
			setcookie('like_'.$id,"yes",time()+60*60*24*365*5);
			$sql="update posts set like_count=like_count+1 where post_id='$id'";
			$opertion="like";
		}
	}
	
	if($type=='dislike'){
		if(isset($_COOKIE['dislike_'.$id])){
			setcookie('dislike_'.$id,"yes",1);
			$sql="update posts set dislike_count=dislike_count-1 where post_id='$id'";
			$opertion="undislike";
		}else{
			
			if(isset($_COOKIE['like_'.$id])){
				setcookie('like_'.$id,"yes",1);
				mysqli_query($connection,"update posts set like_count=like_count-1 where post_id='$id'");
			}
			
			setcookie('dislike_'.$id,"yes",time()+60*60*24*365*5);
			$sql="update posts set dislike_count=dislike_count+1 where post_id='$id'";
			$opertion="dislike";
		}
	}
	mysqli_query($connection,$sql);

	$row=mysqli_fetch_assoc(mysqli_query($connection,"select * from posts where post_id='$id'"));
	
	echo json_encode([
		'opertion'=>$opertion,
		'like_count'=>$row['like_count'],
		'dislike_count'=>$row['dislike_count']
	]);
}
?>
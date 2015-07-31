	var data;
	var vektor;
	var k;
	var benar = 0;
	var jml_data = 0;
	var done = 0;
	var url;
	var last;
	function start(){
		$('#stop').removeClass('disabled');
		$('#start').addClass('disabled');
		pelatihan(1);
	}
	function pelatihan(epoch){
		var max_epoch = $("#max").val();
		if(epoch <= max_epoch){
			$('#load').html("Running...<img src='"+url+"assets/img/gloader.gif' />");
			$('#iterasi').val(last+epoch);
			benar = 0;
			hitung(0,epoch,max_epoch);
		}else{
			selesai();
		}
	}
	
	function stop(){
		done = 1;
	}
	function hitung(num_data,epoch,max_epoch){
		if(num_data < jml_data){
			$.ajax({
				type:"POST",data:{data_latih:data[num_data],v:vektor[k]},dataType:"json",
				url:url+"voted/pelatihan/train/",
				success:function(result){
					if(result[15]==0){
						k = k + 1;
						vektor[k] = result;
					}else{
						benar = benar + 1;
						vektor[k][15] = result[15];
					}
					$('#k').val(k);
					$("#vektor").append("<tr>");
					$("#vektor").append("<td>"+(num_data+1)+"</td><td>"+vektor[k][0]+"</td><td>"+vektor[k][1]+"</td><td>"+vektor[k][2]+"</td><td>"+vektor[k][3]+"</td><td>"+vektor[k][4]+"</td><td>"+vektor[k][5]+"</td><td>"+vektor[k][6]+"</td><td>"+vektor[k][7]+"</td><td>"+vektor[k][8]+"</td><td>"+vektor[k][9]+"</td><td>"+vektor[k][10]+"</td><td>"+vektor[k][11]+"</td><td>"+vektor[k][12]+"</td><td>"+vektor[k][13]+"</td><td>"+vektor[k][14]+"</td><td>"+vektor[k][15]+"</td>");
					$("#vektor").append("</tr>");
					num_data = num_data+1;
					hitung(num_data,epoch,max_epoch);
				}
			});
		}else{
			if(benar == num_data){
				selesai();
			}else{
				if(done==1){
					pelatihan(max_epoch+1);
				}else{
					epoch = epoch+1;
					pelatihan(epoch);
				}
			}
		}
	}
	function selesai(){
		$('#stop').removeClass('disabled');
		$('#start').addClass('disabled');
		$('#load').html("Done...");
		$.ajax({
			type:"POST",data:{v:vektor,epoch:$("#iterasi").val()},dataType:"json",
			url:url+"voted/pelatihan/save/",
			success:function(out){
				$('#stop').addClass('disabled');
				$('#start').removeClass('disabled');
			}
		});
	}
	$(function(){
		$('#stop').addClass('disabled');
		last = parseInt($('#iterasi').val());
		url = $("#url").val();
		$.ajax({
			type:"GET",
			url:url+"voted/pelatihan/get_data_latih/",
			success:function(result){
				data = JSON.parse(result);
				for(var i in data){
					jml_data = jml_data + 1;
				}
				k = 0;
				$('#k').val(k);
			}
		});
		$.ajax({
			type:"GET",
			url:url+"voted/pelatihan/get_vektor/",
			success:function(result2){
				vektor = JSON.parse(result2);
				$("#vektor").append("<tr>");
				$("#vektor").append("<td>0</td><td>"+vektor[0][0]+"</td><td>"+vektor[0][1]+"</td><td>"+vektor[0][2]+"</td><td>"+vektor[0][3]+"</td><td>"+vektor[0][4]+"</td><td>"+vektor[0][5]+"</td><td>"+vektor[0][6]+"</td><td>"+vektor[0][7]+"</td><td>"+vektor[0][8]+"</td><td>"+vektor[0][9]+"</td><td>"+vektor[0][10]+"</td><td>"+vektor[0][11]+"</td><td>"+vektor[0][12]+"</td><td>"+vektor[0][13]+"</td><td>"+vektor[0][14]+"</td><td>"+vektor[0][15]+"</td>");
				$("#vektor").append("</tr>");
			}
		});
	});
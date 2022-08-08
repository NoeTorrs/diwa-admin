(function($){




	function getProvince($region,$form){
		$.ajax(
            {
                type:"GET",
                url: location.origin+"/diwa-admin/api/getProvince?regionPSGC="+$region,
                success:function(response){
                	let res = JSON.parse(response);
               		let html = "";
               		for(let i=0;i<res.length;i++){
               			html+=`<option value="${res[i]['provincePSGC']}">${res[i]['provinceName']}</option>`;
               		}
               		$(`#${$form} #provincePSGC`).html(html);
                }
            });
	}

	function getMunicity($province,$form){
		$.ajax(
            {
                type:"GET",
                url: location.origin+"/diwa-admin/api/getMunicity?provincePSGC="+$province,
                success:function(response){
                	let res = JSON.parse(response);
               		let html = "";
               		for(let i=0;i<res.length;i++){
               			html+=`<option value="${res[i]['municityPSGC']}">${res[i]['municityName']}</option>`;
               		}
               		$(`#${$form} #municityPSGC`).html(html);
                }
            });
	}


	function getBarangay($municity,$form){
		$.ajax(
            {
                type:"GET",
                url: location.origin+"/diwa-admin/api/getBarangay?municityPSGC="+$municity,
                success:function(response){
                	let res = JSON.parse(response);
               		let html = "";
               		for(let i=0;i<res.length;i++){
               			html+=`<option value="${res[i]['barangayPSGC']}">${res[i]['barangayName']}</option>`;
               		}
               		$(`#${$form} #barangayPSGC`).html(html);
                }
            });
	}


	$(document).on("change","#regionPSGC",function(){
		let choice = $(this).val();
		// console.log(choice);
		$('#provincePSGC').html('');
		$('#municityPSGC').html('');
		$('#barangayPSGC').html('');
		let form = $(this).closest("form").attr('id');
		getProvince(choice,form);
	})


	$(document).on("change","#provincePSGC",function(){
		let choice = $(this).val();
		let form = $(this).closest("form").attr('id');
		getMunicity(choice,form);
	})

	$(document).on("change","#municityPSGC",function(){
		let choice = $(this).val();
		let form = $(this).closest("form").attr('id');
		getBarangay(choice,form);
	})


	$(document).on("change","#userJurID",function(){
    	let choice = $(this).val();
		if(choice==1){
			$('#provincePSGC').html('');
			$('#municityPSGC').html('');
			$('#barangayPSGC').html('');
			$('#provincePSGC').attr('required',false);
			$('#municityPSGC').attr('required',false);
			$('#barangayPSGC').attr('required',false);
			$('#auprov').hide();
			$('#aumuni').hide();
			$('#aubrgy').hide();
		}
		else if(choice==2){
			getProvince($('#regionPSGC').val());
			$('#municityPSGC').html('');
			$('#barangayPSGC').html('');
			$('#provincePSGC').attr('required',true);
			$('#municityPSGC').attr('required',false);
			$('#barangayPSGC').attr('required',false);
			$('#auprov').show();
			$('#aumuni').hide();
			$('#aubrgy').hide();
		}
		else if(choice==3){
			getProvince($('#regionPSGC').val());
			getMunicity($('#provincePSGC').val());
			$('#barangayPSGC').html('');
			$('#provincePSGC').attr('required',true);
			$('#municityPSGC').attr('required',true);
			$('#barangayPSGC').attr('required',false);
			$('#auprov').show();
			$('#aumuni').show();
			$('#aubrgy').hide();
		}
		else if(choice==4){
			getProvince($('#regionPSGC').val());
			getMunicity($('#provincePSGC').val());
			getBarangay($('#municityPSGC').val());
			$('#provincePSGC').attr('required',true);
			$('#municityPSGC').attr('required',true);
			$('#barangayPSGC').attr('required',true);
			$('#auprov').show();
			$('#aumuni').show();
			$('#aubrgy').show();
		}

	});

	$('#auform').on('submit',function(){
		event.preventDefault();
		$d = $('#auform').serializeArray();
		$.ajax({
			type:"post",
			url: location.origin+"/diwa-admin/api/adduser",
			data: $d,
			success:function(res){
				console.log(res["message"]);
				$res = JSON.parse(res);
				if($res["message"]){
					Swal.fire({
						title: "Unable to add user",
						text: $res["message"],
						icon: "error",
						timer: 2000,
						showConfirmButton: false
					});
				}
				else{
					Swal.fire({
							title: "Succesfully Added",
							text: "",
							icon: "success",
							timer: 2000,
							showConfirmButton:false
						}).then(function(){
							let myTable = $("#userstable").DataTable();
							let row = [];
							
							row.push(`<p id="uid"><input type="hidden"  id="eid" value='"${$res["UserAttributes"][1]["Value"]}"'><p id="email">${$res["UserAttributes"][1]["Value"]}</p>`);
							row.push(`<p id="ustatus">${$res["UserStatus"]}</p>`);
							if($res["Enabled"]){
								row.push(`<p id="ustatus">Enabled</p>`);
							}
							else{
								row.push(`<p id="ustatus">Disabled</p>`);	
							}
							row.push(`<button class="btndetails btn btn-primary" data-toggle="modal" href="#detailsmodal">Show Details</button>`);
							row.push(`<button class="btn btn-danger">Reset Password</button>`);
							if($res["Enabled"]){
								row.push(`<button class="btn btn-warning">Disable</button>`);
							}
							else{
								row.push(`<button class="btn btn-success">Enable</button>`);	
							}

							myTable.row.add(row).draw();
							$('#auform')[0].reset(); 
						});
				}
			}
		})
	})


	$(document).on('click','.btndetails',function(){
		// event.preventDefault();
		$email = $(this).closest('tr').children().children().children("#eid").val();
		console.log($email);
		$('#detailsmodal #auprov').hide();
		$('#detailsmodal #aumuni').hide();
		$('#detailsmodal #aubrgy').hide();
		$form = $('#detailsmodal').closest("form").attr('id');
		console.log($form);
		$.ajax({
			type:"post",
			url: location.origin+"/diwa-admin/api/getDetails",
			data: {"email":$email},
			success:function(res){
				$d = JSON.parse(res)[0];
				console.log($d);
				if($d["provincePSGC"]){
					$('#detailsmodal #auprov').show();
					getProvince($d["regionPSGC"],$form);
					
				}
				if($d["municityPSGC"]){
					$('#detailsmodal #aumuni').show();
					getMunicity($d["provincePSGC"],$form);
						
				}
				if($d["barangayPSGC"]){
					$('#detailsmodal #aubrgy"').show();
					getBarangay($d["municityPSGC"],$form);
				}
				$('#detailsmodal [name="email"]').val($d["email"]);
				$('#detailsmodal [name="userTypeID"]').val($d["userTypeID"]).change();
				$('#detailsmodal [name="agencyID"]').val($d["agencyID"]).change();
				$('#detailsmodal [name="agencyName"]').val($d["agencyName"]);
				$('#detailsmodal [name="userJurID"]').val($d["userJurID"]);
				$('#detailsmodal [name="regionPSGC"]').val($d["regionPSGC"]);
				
				$('#detailsmodal [name="provincePSGC"]').val($d["provincePSGC"]);
				$('#detailsmodal [name="municityPSGC"]').val($d["municityPSGC"]);
				$('#detailsmodal [name="barangayPSGC"]').val($d["barangayPSGC"]);
				$('#detailsmodal [name="prefix"]').val($d["prefix"]);
				$('#detailsmodal [name="firstName"]').val($d["firstName"]);
				$('#detailsmodal [name="middleName"]').val($d["middleName"]);
				$('#detailsmodal [name="lastName"]').val($d["lastName"]);
				$('#detailsmodal [name="suffix"]').val($d["suffix"]);
				$('#detailsmodal [name="birthdate"]').val($d["birthdate"]);
				$('#detailsmodal [name="sexonbirth"]').val($d["sexonbirth"]).change();
			}
		});
	})




})(jQuery);
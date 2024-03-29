<?php 

	// Resource fields validation
	$this->validate($request,[
	    'resource'      => 'required',
	]);


	// File upload into Public folder
	if($request->hasFile('resource')){
	    $filenameWithExt = $request->file('resource')->getClientOriginalName();
	    
	    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
	    $extension = $request->file('resource')->getClientOriginalExtension();
	    $fileNameToStore = $filename.'_'.time().'.'.$extension;
	    
	    // Move File inside public/uploads/images/resource folder
	    $path = $request->file('resource')->move('uploads/images/resource', $fileNameToStore);

	}
	else{
	    $fileNameToStore = 'noimage.jpg'; // if no image selected this will be the default image
	}



	// sample database store query
	$insert = DB::table('KOSM_RESOURCE')->insert([
	    'RESOURCE_FILE_PATH' => $fileNameToStore,
	    'ENTERED_BY' => Auth::user()->USER_ID, // should be auth user
	    'ENTRY_TIMESTAMP' => Carbon::now()
	]);


?>



<?php

	// image upload into Storage folder
	if($request->hasFile('blog_image')){
	    $filenameWithExt = $request->file('blog_image')->getClientOriginalName();
	    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
	    $extension = $request->file('blog_image')->getClientOriginalExtension();
	    $fileNameToStore = $filename.'_'.time().'.'.$extension;
	    
	    // File upload inside storage/app/public/images/blog folder
	    $path = $request->file('blog_image')->storeAs('public/images/blog', $fileNameToStore);
	}
	else{
	    $fileNameToStore = 'noimage.jpg'; // if no image selected this will be the default image
	}


?>
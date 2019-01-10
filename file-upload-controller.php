
// File upload
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
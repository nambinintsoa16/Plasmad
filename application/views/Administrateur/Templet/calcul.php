<div class="container">
   <div class="card mt-3">
         <div class="card-header bg-primary text-white">
            <b>PU MATERIEL</b>
         </div>
         <div class="card-body">
		 <form action="Administrateur/caltculPrix" method="POST" class="form w-100">
           <div class="row">
			 
			   <div class="form-group col-md-12 text-right">
					<label class="mr-3">Prix applique pour : </label>
					<select class="form-control typeDeproduit form-control-sm col-md-3 pull-right"  name="type_prix">
						<option value="1">Direct Printed rolls</option>
						<option value="2">Direct rolls plain</option>
						<option value="3">PE Bottom Seal Bag</option>
						<option value="4">PE Side Seal bag</option>
						<option value="5">PP side seal bag</option>
					</select>	
			   </div>
               <div class="form-group col-md-4">
			 		<label for="HDPE_LDPE">HDPE/LDPE : </label> 
					<input type="text"    class="form-control form-control-sm " placeholder="Std Ratio" name="HDPE_LDPE">
					<input type="text"    class="form-control form-control-sm  mt-2" placeholder="Rate" name="HDPE_LDPERATE">
			   </div>
			   <div class="form-group col-md-4 ">
			   		<label for="LLDPE">LLDPE : </label>
					<input type="text"   class="form-control form-control-sm" name="LLDPE"  placeholder="Std Ratio">
					<input type="text"    class="form-control form-control-sm mt-2" name="LLDPERATE" placeholder="Rate">
			   </div>
			   <div class="form-group col-md-4">
			   		<label for="Borstar">Borstar : </label>
					<input type="text"   class="form-control form-control-sm " name="Borstar" placeholder="Std Ratio">
					<input type="text"    class="form-control form-control-sm mt-2"  name ="BorstarRATE" placeholder="Rate">
			   </div>
			   <div class="form-group col-md-4">
			   		<label for="Elastomers_Vistamaxx">Elastomers/Vistamaxx : </label>
					<input type="text"   class="form-control form-control-sm " name="Elastomers_Vistamaxx"  placeholder="Std Ratio">
					<input type="text"    class="form-control form-control-sm mt-2"  name ="Elastomers_Vistamax" placeholder="Rate">
			   </div>
			   <div class="form-group col-md-4">
			   		<label for="Recycled">Recycled : </label>
					<input type="text" class="form-control form-control-sm"  name ="Recycled" placeholder="Std Ratio">
					<input type="text" class="form-control form-control-sm mt-2"  name ="RecycledRate" placeholder="Rate">
			   </div>
			   <div class="form-group col-md-4">
			   		<label for="CaCo3">CaCo3 : </label>
					<input type="text" name="CaCo3"   class="form-control form-control-sm" placeholder="Std Ratio">
					<input type="text" class="form-control form-control-sm mt-2"  name ="CaCo3Rate" placeholder="Rate">
			   </div>
			   <div class="form-group col-md-4">
			   	  	<label for="Master_batch">Master batch : </label>
					<input type="text"  class="form-control form-control-sm"  name ="Elastomers_VistamaxRateStd" placeholder="Std Ratio">
					<input type="text"  class="form-control form-control-sm mt-2"  name ="Elastomers_VistamaxRate" placeholder="Rate">
			   </div>
               <div class="form-group col-md-7 pt-5 text-right" style="margin-top: -10px;">
			   	 <button type="submit" class="btn btn-success btn-sm text-uppercase">Valider</button>
			   </div>
			   
		   </div>
</form>


             <div class="table content-table">
                
             </div>
         </div>
   </div>
</div>


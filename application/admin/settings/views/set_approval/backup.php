<?php foreach($flow as $d) { ?>
							<?php $check = ($d->mandatory==1) ? 'checked' : '' ; ?>
							<tr>
								<td><?php echo $d->nama; ?></td>

								<td class="text-center">						
									<div class="custom-checkbox custom-control">
										<input class="custom-control-input chk" type="checkbox" id="<?php echo 'check'. $d->id; ?>" name="<?php echo 'check['. $d->id.']'; ?>" value="<?php echo $d->mandatory; ?>" checked="<?php echo $check; ?>">
										<label class="custom-control-label" for="<?php echo 'check'. $d->id; ?>"></label>
									</div>
								</td>
								<td width="250">
									<select style="width:250px" class="form-control select2 bar nama_pic" name="nama_pic[]" aria-label="" data-validation="">
											<option value=""></option>
											<?php
											foreach ($user as $ma){  ?>
												<option value="<?php echo $ma['id'] ?>"><?php echo $ma['nama']; ?> </option>
												<?php	
										} ?>
									</select></td>
								<td>
									<?php
									imageupload(lang('photo'),'tanda_tangan['.$d->id.']','100','100','force');			
									?>
								</td>	
							</tr>
							<?php } ?>
                    <tr>
                      <td>
                        <div class="thumb_cart">
                          <img style="height:40px;width:40px" src="<?php echo $extra->thumbnail;?>" alt="<?php echo $extra->extraTitle;?>">
                        </div>
                      </td>
                      <td>
                        <span class="item_cart"><?php echo $extra->extraTitle;?></span>
                      </td>
                      <td>
                        <?php echo $room->currCode;?> <?php echo $room->currSymbol;?><?php echo $extra->extraPrice;?>
                      </td>
                      <td>
                        <label class="switch-light switch-ios">
                        <input type="checkbox" id="<?php echo $extra->id;?>" name="extras[]" value="<?php echo $extra->id;?>" onclick="updateBookingData('<?php echo $extraChkUrl;?>')">
                        <span>
                        <span><?php echo trans('0364');?></span>
                        <span><?php echo trans('0363');?></span>
                        </span>
                        <a></a>
                        </label>
                      </td>
                    </tr>
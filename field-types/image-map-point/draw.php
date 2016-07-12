<?php
	if (empty($field["value"]) || !is_array($field["value"])) {
		$field["value"] = array("left" => "50", "top" => "50");
	}

	if ($field["options"]["size"] == "small") {
		$margin = 4;
		$border = 2;
		$size = 4;
	} elseif ($field["options"]["size"] == "large") {
		$margin = 10;
		$border = 5;
		$size = 10;
	} else {
		$margin = 6;
		$border = 4;
		$size = 8;
	}
?>
<style>
	#<?=$field["id"]?>_container {
		position: relative;
	}

	#<?=$field["id"]?>_container img {
		display: block;
		width: 100%;
	}

	#<?=$field["id"]?>_point {
		background: #59A8E9;
		border: <?=$border?>px solid #333;
		border-radius: 100%;
		cursor: grab;
		height: <?=$size?>px;
		margin: -<?=$margin?>px 0 0 -<?=$margin?>px;
		position: absolute;
		width: <?=$size?>px;
	}

	#<?=$field["id"]?>_point.ui-draggable-dragging {
		cursor: grabbing;
	}
</style>

<div id="<?=$field["id"]?>_container">
	<input type="hidden" name="<?=$field["key"]?>" value="<?=htmlspecialchars(json_encode($field["value"]))?>">
	<img src="<?=$field["options"]["image"]?>">
	<div id="<?=$field["id"]?>_point" style="left: <?=$field["value"]["left"]?>%; top: <?=$field["value"]["top"]?>%;"></div>
</div>

<script>
	$("#<?=$field["id"]?>_point").draggable({
		containment: "parent",
		stop: function(event, ui) {
			var container = $("#<?=$field["id"]?>_container");
			var container_offset = container.offset();

			// Calculate the offset %
			var left = 100 * (ui.offset.left - container_offset.left) / container.width();
			var top = 100 * (ui.offset.top - container_offset.top) / container.height();

			// Set the hidden field value
			container.find("input").val(JSON.stringify({ left: left, top: top }));
		}
	});
</script>
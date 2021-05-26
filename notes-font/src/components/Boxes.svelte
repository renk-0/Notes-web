<script>
	import {createEventDispatcher} from "svelte";
	import Box from "./Box.svelte";
	import axios from "axios";

	const dispatcher = createEventDispatcher();
	let currentBox;
	let boxes = [];

	export const get_current = () => currentBox;
	export const add_box = (box) => boxes[boxes.length] = box;

	function get_boxes() {
		axios.get("http://localhost/Notas/getBoxes")
			.then(resp =>  boxes = resp.data );
	} 

	function change_box() {
		if(currentBox)
			currentBox.close_box();
		currentBox = this;
		dispatcher("box_selected");
	}

	get_boxes();
</script>

<div class="box_container">
	{#each boxes as box}
		<Box {...box} on:opened={change_box} on:view_note />
	{/each}
</div>

<style>
	.box_container {
		border: 0 solid var(--snd-border-col);
		border-width: 0 2px 0 0;
		background: var(--snd-background);
		flex: 1 1 200px;
		height: 100%;
		overflow: auto;
	}
</style>


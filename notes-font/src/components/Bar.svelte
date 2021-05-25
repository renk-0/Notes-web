<script>
	import {createEventDispatcher} from "svelte";
	const dispatcher = createEventDispatcher();

	const folder = () => dispatcher("folder");
	const note = () => dispatcher("note");
	const _delete = () => dispatcher("_delete");
</script>

<div class="menu-bar">
	<button class="secondary" on:click={folder}>New Folder</button>
	<button class="primary" on:click={note}>New Note</button>
</div>

<?php

helper("asset");

if(helper_add("asset")){

	function asset(?string $static_dir = null, ?string $root_dir = null){

		if(is_null($root_dir) && is_null($static_dir))
			return event("provider.asset")->exec();

		if(is_null($root_dir))
			$root_dir = env("root_dir");

		if(is_null($static_dir))
			$static_dir = env("rel_static_dir");

		if(notnull($root_dir) && notnull($static_dir))
			return event("service.asset")->applyArgs([$root_dir, $static_dir])->exec();
	}
}
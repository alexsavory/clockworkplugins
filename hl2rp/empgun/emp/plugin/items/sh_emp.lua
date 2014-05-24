--[[
	© 2013 CloudSixteen.com do not share, re-distribute or modify
	without permission of its author (kurozael@gmail.com).
--]]

local ITEM = Clockwork.item:New("weapon_base");
	ITEM.name = "Prototype EMP Tool";
	ITEM.cost = 500;
	ITEM.model = "models/alyx_emptool_prop.mdl";
	ITEM.weight = 0.8;
	ITEM.access = "V";
	ITEM.classes = {CLASS_EOW};
	ITEM.uniqueID = "emp_tool";
	ITEM.business = false;
	ITEM.description = "A Small Device Filled with energy. Doesnt Look Stable";
ITEM:Register();
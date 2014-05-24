local ITEM = Clockwork.item:New();
ITEM.name = "Event Logger";
ITEM.cost = 200;
ITEM.model = "models/props_lab/keypad.mdl";
ITEM.weight = 1;
ITEM.category = "Utility";
ITEM.factions = {FACTION_MPF, FACTION_OTA};
ITEM.business = false;
ITEM.description = "A lightweight device. It's made of strange materials.";

-- Called when a player uses the item.
function ITEM:OnUse(player, itemEntity)
	player:SendLua("surface.PlaySound('ambient/machines/thumper_hit.wav')")
	player:SendLua("ViewLogger()");
	return false;
end;

ITEM:Register();
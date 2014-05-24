--[[
	© 2013 CloudSixteen.com do not share, re-distribute or modify
	without permission of its author (kurozael@gmail.com).
--]]

local ITEM = Clockwork.item:New();
	ITEM.name = "Combine Sentry Gun";
	ITEM.cost = 500;
	ITEM.model = "models/Combine_turrets/Floor_turret.mdl";
	ITEM.weight = 4;
	ITEM.access = "V";
	ITEM.classes = {CLASS_EOW};
	ITEM.business = false;
	ITEM.description = "A fully autonomous tripodal pulse gun. 'V952' are engraved on the side. Good luck carrying it.";
	ITEM.category = "Utility";

-- Called when a player uses the item.
function ITEM:OnUse(player, itemEntity)
	local tr = player:GetEyeTraceNoCursor();
	local ent = ents.Create("combine_turret") -- This creates our zombie entity
	ent:SetPos(tr.HitPos) -- This positions the zombie at the place our trace hit.
	ent:Spawn() -- This method spawns the zombie into the world, run for your lives! ( or just crowbar it dead(er) )
end;


-- Called when a player drops the item.
function ITEM:OnDrop(player, position) end;
ITEM:Register();

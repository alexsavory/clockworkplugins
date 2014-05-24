--[[
	© 2013 CloudSixteen.com do not share, re-distribute or modify
	without permission of its author (kurozael@gmail.com).
--]]

local COMMAND = Clockwork.command:New("poi");
COMMAND.tip = "Dispatch to Person Of interest. Look in clockwork directory for more info'";
COMMAND.text = "<string Name> <string dispatch>";
COMMAND.access = "o";
COMMAND.arguments = 2;

-- Called when the command has been run.
function COMMAND:OnRun(player, arguments)
	if (Schema:PlayerIsCombine(player)) then
		if (Schema:IsPlayerCombineRank( player, {"SCN", "DvL", "SeC"} ) or player:GetFaction() == FACTION_OTA) then
			local target = Clockwork.player:FindByID( arguments[1] )
			local message = arguments[2]
	
			if (target) then
				PersonalDispatch(target,message)
			else
				Clockwork.player:Notify(player, arguments[1].." is not a valid character!");
			end;
		end
	end
end;

COMMAND:Register();
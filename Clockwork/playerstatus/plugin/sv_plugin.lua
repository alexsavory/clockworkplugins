--[[
	© 2013 CloudSixteen.com do not share, re-distribute or modify
	without permission of its author (kurozael@gmail.com).

	Clockwork was created by Conna Wiles (also known as kurozael.)
	https://creativecommons.org/licenses/by-nc-nd/3.0/legalcode
--]]

-- Called when a player attempts to say something in-character.
local PLUGIN = PLUGIN
local Clockwork = Clockwork
function Clockwork:PlayerCanSayIC(player, text)
	if ((!player:Alive() or player:IsRagdolled(RAGDOLL_FALLENOVER)) and !self.player:GetDeathCode(player, true)) then
		return false;
	else
		Clockwork.kernel:PrintLog(LOGTYPE_GENERIC, player:Name().." said stuff");
		return true;
	end;
end;

function Clockwork:PlayerSay(player, text, bPublic) 
	Clockwork.kernel:PrintLog(LOGTYPE_GENERIC, player:Name().." said stuff");
	end;